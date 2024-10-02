<?php

namespace App\Console\Commands;

use App\Models\EngineType;
use App\Models\FuelType;
use App\Models\Model;
use App\Models\Style;
use App\Models\Vehicle;
use Illuminate\Console\Command;
use SoapClient;

class CreateLocalStoreData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-local-store';

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
            $vehicles = Vehicle::where('name', 'like', '%2024%')->get();
            foreach($vehicles as $vehicle){
                $json = json_decode($vehicle->data);
                $vehicle->pricing = $json->style->basePrice->msrp;

                if(isset($json->engine->horsepower->value)){
                    $vehicle->horsepower = $json->engine->horsepower->value;
                }

                if(isset($json->engine->netTorque->value)){
                    $vehicle->torque = $json->engine->netTorque->value;
                }

                if(isset($json->bestMakeName)){
                    $vehicle->division = $json->bestMakeName;
                }

                if(isset($json->bestModelName)){
                    $vehicle->model = $json->bestModelName;
                }

                if(isset($json->bestStyleName)){
                    $vehicle->style = $json->bestStyleName;
                }

                if(isset($json->engine->fuelEconomy->city->low)){
                    $vehicle->mpg_city = $json->engine->fuelEconomy->city->low;
                }

                if(isset($json->engine->fuelEconomy->hwy->low)){
                    $vehicle->mpg_hwy = $json->engine->fuelEconomy->hwy->low;
                }

                foreach($json->technicalSpecification as $tech){
                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Passenger Capacity'){
                        $vehicle->seating = isset($tech->value->value) && $tech->value->value ? $tech->value->value : 0;
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Head Room'){
                        $vehicle->front_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Head Room'){
                        $vehicle->second_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Leg Room'){
                        $vehicle->front_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Leg Room'){
                        $vehicle->second_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Shoulder Room'){
                        $vehicle->front_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Shoulder Room'){
                        $vehicle->second_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Length, Overall'){
                        $vehicle->length_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Height, Overall'){
                        $vehicle->height_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume with Rear Seat Up'){
                        $vehicle->cargo_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Trunk Volume'){
                        $vehicle->trunk_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }

                    if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Estimated Battery Range'){
                        $vehicle->battery_range = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
                    }
                }

                $vehicle->save();
            }
            dd('done'); 
    }
}
