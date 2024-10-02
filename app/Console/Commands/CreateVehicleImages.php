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

class CreateVehicleImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-vehicle-images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the vehicle images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $context = stream_context_create(array(
            'http' => array(
                'ignore_errors' => true,
                'header'  => "Authorization: Basic " . base64_encode("$usernumber:$secretKey")
            )
        ));

        $style_vehicles = DB::select("SELECT vehicles.style_id
        FROM vehicles
        LEFT JOIN vehicle_images ON vehicles.style_id = vehicle_images.style_id
        WHERE vehicle_images.style_id IS NULL and pricing is not null and name like '%2023%' GROUP by vehicles.style_id");

        // dd();
        // $styles = Style::where('images_dump', 0)->get();
        // $styles = Style::doesntHave('images')->whereMonth('created_at', 11)->get();
        //$style_vehicles = Vehicle::where('name', 'like', '%2024%')->where('image', '')->pluck('style_id')->toArray();

        $styles = Style::whereIn('number', collect($style_vehicles)->pluck('style_id')->toArray())->get();
        
        foreach($styles as $style){
            DB::table('api_request_logs')->insert(['request_type' => 'images', 'request_from' => request()->ip(), 'created_at' => now()]);
            $api_logs = DB::table('api_request_logs')->whereDate('created_at', date('Y-m-d'))->count();

            if($api_logs > 1000){
                $this->info('request limit exceed!');
                exit;
            }

            $gallery_api = file_get_contents('http://media.chromedata.com/MediaGallery/service/style/'.$style->number.'.json', false, $context);
            //$images = isset(json_decode($gallery_api)->view[4]) ? (array)json_decode($gallery_api)->view[4]: (isset(json_decode($gallery_api)->view[0]) ? json_decode($gallery_api)->view[0] : ['@href' => '']) ;
            //dd($gallery_api);
            // $images = json_decode($gallery_api);
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
                            Vehicle::where('style_id', $style->number)->update(['image' => $cover_image]);
                        } catch (\Throwable $th) {
                            //throw $th;
                        }
                        
                    }
                }

                $style->images_dump = 1;
                $style->save();
            }
        }    
    }
}
