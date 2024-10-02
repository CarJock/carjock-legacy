<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Vehicle;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('dumpdata', function(){
    $vehicles = Vehicle::orderBy('pricing', 'desc')->paginate(500);
    foreach($vehicles as $vehicle){
        $json = json_decode($vehicle->data);
        if(isset($json->bestMakeName)){
            $vehicle->division = $json->bestMakeName;
        }
        
        if(isset($json->style->basePrice->msrp)){
            $vehicle->pricing = $json->style->basePrice->msrp;
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
            
            if(isset($tech->definition->title->_) && $tech->definition->title->_ === 'Passenger Capacity'){
                $vehicle->seating = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null  );
            }
        }

        $vehicle->save();
    }
    dd('done');
});
