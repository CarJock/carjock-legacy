<?php

namespace App\Console\Commands;

use App\Models\EngineType;
use App\Models\FuelType;
use App\Models\Model;
use App\Models\Style;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SoapClient;

class CreateVehicle extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-vehicle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the vehicle information after storing all the model for the division';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number'=> $usernumber, 'secret'=> $secretKey, 'country'=>"US",    'language'=>"en"];
        $context = stream_context_create(array(
            'http' => array(
                'ignore_errors' => true,
                'header'  => "Authorization: Basic " . base64_encode("$usernumber:$secretKey")
            )
        ));

        $styles = Style::where('dump', 0)->get();
        foreach($styles as $style){
            //Log API's call
            DB::table('api_request_logs')->insert(['request_type' => 'vehicles', 'request_from' => request()->ip(), 'created_at' => now()]);
            $api_logs = DB::table('api_request_logs')->whereMonth('created_at', date('m'))->count();

            // if($api_logs > 1000){
            //     $this->info('request limit exceed!');
            //     exit;
            // }
            //Stop execution API's if limit exceed 1000

            $vehicle_exists = Vehicle::where('style_id', $style->id)->first();
            if(!$vehicle_exists){
                $vehicle = $client->describeVehicle([
                    'accountInfo' => $account,
                    'styleId' => $style->number,
                    'switch' => ['ShowExtendedDescriptions', 'ShowExtendedTechnicalSpecifications', 'IncludeDefinitions', 'ShowAvailableEquipment'],
                    'SwitchChromeMediaGallery' => 'Both'
                ]);

                if(isset($vehicle->responseStatus->responseCode) && $vehicle->responseStatus->responseCode == 'Successful'){
                    $fuel_type = (object) ['id' => 0];
                    $engine_type = (object) ['id' => 0];
                    if(isset($vehicle->engine->fuelType) && $vehicle->engine->fuelType->_){
                        $fuel_type = FuelType::create([
                            'name' => $vehicle->engine->fuelType->_,
                            'number' => $vehicle->engine->fuelType->id,
                            'economy' => isset($vehicle->engine->fuelEconomy) ? json_encode($vehicle->engine->fuelEconomy) : json_encode([]),
                            'capacity' => isset($vehicle->engine->fuelCapacity) ? json_encode($vehicle->engine->fuelCapacity) : json_encode([]),
                        ]);
                    }

                    if(isset($vehicle->engine->engineType) && $vehicle->engine->engineType->_){
                        $engine_type = EngineType::create([
                            'name' => $vehicle->engine->engineType->_,
                            'number' => $vehicle->engine->engineType->id,
                        ]);
                    }

                    //Insert IMAGES
                    //http://media.chromedata.com/MediaGallery/media/MzMxMzI4Xk1lZGlhIEdhbGxlcnk/yFFqSZVnygQBiGCNvT8RfuT-KeCq6JSat_iSSzDYkLSAfUgU3XFVOTFhbHGBpuFt83TWEBofh5venNoO8BJYwGQEgumVRGsqlxFAgCHEz1D3V3W4UCNLYYSpqLqzQyfAQHqqovZ31ZCvWGEOTsc5MOZJjDrzjQ3NGEJOeTj1-rM/2024FOS090035_2100_01.jpg
                    $gallery_api = file_get_contents('http://media.chromedata.com/MediaGallery/service/style/'.$style->number.'.json', false, $context);
                    //Another API called for images
                    DB::table('api_request_logs')->insert(['request_type' => 'images', 'request_from' => request()->ip(), 'created_at' => now()]);

                    $images = json_decode($gallery_api);
                    $cover_image = '';
                    if(isset($images->view[0])){
                        foreach($images->view as $image){
                            //Full dash 12
                            //Front Facing to left 1
                            //Rear Facing to right 2
                            if(isset($image->{'@shotCode'}) && ($image->{'@shotCode'} == "01" || $image->{'@shotCode'} == "02" || $image->{'@shotCode'} == "12") && $image->{'@width'} == "2100" && $image->{'@backgroundDescription'} == "White"){
                                //Another API called for images
                                DB::table('api_request_logs')->insert(['request_type' => 'single_image', 'request_from' => request()->ip(), 'created_at' => now()]);
                                try {
                                    $contents = file_get_contents($image->{'@href'});
                                    $file_path = substr($image->{'@href'}, strrpos($image->{'@href'}, '/') + 1);
                                    Storage::put('public/vehicles/' . $file_path, $contents);

                                    if($image->{'@shotCode'} == "01")
                                        $cover_image = 'storage/vehicles/'.$file_path;

                                    $vehicle_image = new VehicleImage();
                                    $vehicle_image->style_id = $style->number;
                                    $vehicle_image->image = 'storage/vehicles/'.$file_path;
                                    $vehicle_image->type = $image->{'@shotCode'};
                                    $vehicle_image->data = json_encode($image);
                                    $vehicle_image->save();
                                } catch (\Throwable $th) {
                                    //throw $th;
                                }
                                
                            }
                        }

                        $style->images_dump = 1;
                        $style->save();
                    }
                    
                    foreach($vehicle->technicalSpecification as $tech){
                        $front_head_room = '';
                        $second_head_room = '';
                        $front_leg_room = '';
                        $second_leg_room = '';
                        $front_shoulder_room = '';
                        $second_shoulder_room = '';
                        $length_overall = '';
                        $height_overall = '';
                        $cargo_volume = '';
                        $trunk_volume = '';
                        $battery_range = '';

                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Head Room'){
                            $front_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Head Room'){
                            $second_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Leg Room'){
                            $front_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Leg Room'){
                            $second_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Shoulder Room'){
                            $front_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Shoulder Room'){
                            $second_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Length, Overall'){
                            $length_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Height, Overall'){
                            $height_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume with Rear Seat Up'){
                            $cargo_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Trunk Volume'){
                            $trunk_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
    
                        if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Estimated Battery Range'){
                            $battery_range = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                        }
                    }

                    Vehicle::create([
                        'style_id' => $style->number,
                        'engine_type_id' => $engine_type->id,
                        'fuel_type_id' => $fuel_type->id,
                        'name' => $vehicle->modelYear . ' '. $vehicle->style->division->_ . ' '. $vehicle->style->model->_ . ' ' .$vehicle->style->name,
                        'body_type' => is_array($vehicle->style->bodyType) ? $vehicle->style->bodyType[0]->_ : $vehicle->style->bodyType->_,
                        'data' => json_encode($vehicle),
                        // 'image' => $images['@href']
                        'image' => $cover_image,

                        'division' => isset($vehicle->bestMakeName) ? $vehicle->bestMakeName : '',
                        'model' => isset($vehicle->bestModelName) ? $vehicle->bestModelName : '',
                        'style' => isset($vehicle->bestStyleName) ? $vehicle->bestStyleName : '',
                        'mpg_city' => isset($vehicle->engine->fuelEconomy->city->low) ? $vehicle->engine->fuelEconomy->city->low : '',
                        'mpg_hwy' => isset($vehicle->engine->fuelEconomy->hwy->low) ? $vehicle->engine->fuelEconomy->hwy->low : '',

                        //technical specifications
                        'front_head_room' => $front_head_room,
                        'second_head_room' => $second_head_room,
                        'front_leg_room' => $front_leg_room,
                        'second_leg_room' => $second_leg_room,
                        'front_shoulder_room' => $front_shoulder_room,
                        'second_shoulder_room' => $second_shoulder_room,
                        'length_overall' => $length_overall,
                        'height_overall' => $height_overall,
                        'cargo_volume' => $cargo_volume,
                        'trunk_volume' => $trunk_volume,
                        'battery_range' => $battery_range,
                    ]);

                }

                $style->dump = 1;
                $style->save();
            }
        }       
    }
}
