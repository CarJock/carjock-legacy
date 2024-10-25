<?php

namespace App\Http\Controllers\Admin;

use App\Models\Model;
use App\Models\Style;
use App\Models\Vehicle;
use App\Models\Division;
use App\Models\FuelType;
use App\Models\EngineType;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use App\Jobs\PullVehiclesJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ChromeDataController extends Controller
{
    public function handleJob(Request $request)
    {
        // Validate the request
        $v = Validator::make($request->all(), [
            'year' => 'required',
            'division' => 'required',
            'model' => 'required',
            'style' => 'required|array',
        ]);

        // Variables to repopulate models and styles if validation fails
        $models = [];
        $styles = [];
        $selectedDivisionName = null;
        $selectedModelName = null;

        // If validation fails
        if ($v->fails()) {
            // Repopulate models if a division is selected
            if ($request->has('division')) {
                $selectedDivision = Division::find($request->input('division'));
                if ($selectedDivision) {
                    $selectedDivisionName = $selectedDivision->name;
                    $models = Model::where('division_id', $selectedDivision->id)->get();
                }
            }

            // Repopulate styles if a model is selected
            if ($request->has('model')) {
                $selectedModel = Model::find($request->input('model'));
                if ($selectedModel) {
                    $selectedModelName = $selectedModel->name;
                    $styles = Style::where('model_id', $selectedModel->id)->get();
                }
            }

            // Use session flash to store the data
            session()->flash('models', $models);
            session()->flash('styles', $styles);
            session()->flash('selectedDivisionName', $selectedDivisionName);
            session()->flash('selectedModelName', $selectedModelName);

            // Redirect back with errors and input
            return redirect()->back()
                ->withErrors($v->errors())
                ->withInput();
        }

        // Proceed with the rest of your logic...
        $year = $request->input('year');
        $division = $request->input('division');
        $freePull = $request->input('free_pull', false); // Checkbox for free pull, default to false

        if ($freePull) {
            PullVehiclesJob::dispatch($year, $division, true);
        } else {
            PullVehiclesJob::dispatch($year, $division, false);
        }

        return back()->with([
            'message' => 'The vehicle pull job has been initiated successfully.',
            'alert-type' => 'success',
        ]);
    }

    public function getModelsByDivision(Request $request)
    {
        $divisionId = $request->input('division_id');
        $year = $request->input('year'); // Retrieve the selected year

        if ($divisionId === 'all') {

            $models = Model::whereIn('division_id', Division::where('year', $year)->pluck('id')->toArray())
                ->select('id', 'division_id', 'number', 'name')
                ->get();
        } else {
            $models = Model::where('division_id', $divisionId)
                ->select('id', 'division_id', 'number', 'name')
                ->get();
        }

        return response()->json(['models' => $models]);
    }


    public function getStylesByModel(Request $request)
    {
        $year = $request->input('year');
        $modelId = $request->input('model_id');
        $divisionId = $request->input('division_id');
        // Fetch division IDs for the selected year
        if ($divisionId == 'all') {
            $divisionIds = Division::where('year', $year)->pluck('id')->toArray();
        }

        if ($modelId === 'all') {
            if ($divisionId && $divisionId != 'all') {
                $modleIds = Model::where('division_id', $divisionId)->pluck('id')->toArray();
            } else {
                $modleIds = Model::whereIn('division_id', $divisionIds)->pluck('id')->toArray();
            }
            // Fetch styles for all models of the selected division IDs
            $styles = Style::whereIn('model_id', $modleIds)->get();
        } else {
            // Fetch styles related to the selected model
            $styles = Style::where('model_id', $modelId)->get();
        }

        return response()->json(['styles' => $styles]);
    }

    public function getVehiclesByStyles(Request $request)
    {
        $styleIds = $request->input('style_ids');
        $modelId = $request->input('model_id');
        $divisionId = $request->input('division_id');
        $year = $request->input('year');

        // If "all" is selected in styles dropdown
        if (is_array($styleIds) && in_array('all', $styleIds)) {
            // Check if "all" is selected in models
            if ($modelId == 'all') {
                // Fetch division IDs based on the year
                if ($divisionId == 'all') {
                    // Get all division IDs for the selected year
                    $divisionIds = Division::where('year', $year)->pluck('id')->toArray();
                } else {
                    // Use the selected division ID
                    $divisionIds = [$divisionId];
                }
                // Get all model IDs from those divisions
                $modelIds = Model::whereIn('division_id', $divisionIds)->pluck('id')->toArray();
            } else {
                // If a specific model is selected, use it
                $modelIds = [$modelId];
            }

            // Fetch style IDs from selected models
            $styleIds = Style::whereIn('model_id', $modelIds)->pluck('id')->toArray();

            // Get the vehicle count for all styles found
            $vehicleCount = Vehicle::whereIn('style_id', $styleIds)->count();

            return response()->json([
                'vehicles' => ['id' => $vehicleCount, 'name' => 'Number of Vehicles found: ' . $vehicleCount]
            ]);
        }

        // Fetch vehicles for specific styles if style IDs are provided
        if (is_array($styleIds) && count($styleIds) > 0) {
            $vehicles = Vehicle::whereIn('style_id', $styleIds)->get();
            return response()->json(['vehicles' => $vehicles]);
        } else {
            // Return empty response if no styles are selected
            return response()->json(['vehicles' => []], 400);
        }
    }


    public function getDivisionsByYear(Request $request)
    {
        $year = $request->input('year');

        // Query the divisions by the selected year
        $divisions = Division::where('year', $year)->get();

        // Return the divisions as a JSON response
        return response()->json(['divisions' => $divisions]);
    }

    public function updateModels(Request $request)
    {
        $divisionId = $request->input('division_id');
        $year = $request->input('year');

        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = [
            'number' => config('services.jdpower.client_id'),
            'secret' => config('services.jdpower.client_secret'),
            'country' => 'US',
            'language' => 'en'
        ];

        $updatedModels = [];

        if ($divisionId === 'all') {
            // Fetch divisions for the specified year only
            $divisions = Division::where('year', $year)->get();  // Assuming the 'year' column exists in the divisions table
            foreach ($divisions as $division) {
                // Fetch models for each division in the specified year
                $chromeModels = $client->getModels([
                    'accountInfo' => $account,
                    'modelYear' => $year,
                    'divisionId' => $division->number
                ]);

                if (isset($chromeModels->responseStatus->responseCode) && $chromeModels->responseStatus->responseCode == 'Successful') {
                    foreach ($chromeModels->model as $chromeModel) {
                        $existingModel = Model::updateOrCreate(
                            ['division_id' => $division->id, 'number' => $chromeModel->id],
                            ['name' => $chromeModel->_]
                        );
                        $updatedModels[] = $existingModel;
                    }
                }
            }
        } else {
            // Fetch a specific division
            $division = Division::where('id', $divisionId)->where('year', $year)->firstOrFail();

            // Fetch models for the specific division
            $models = $client->getModels([
                'accountInfo' => $account,
                'modelYear' => $year,
                'divisionId' => $division->number
            ]);

            if (isset($models->responseStatus->responseCode) && $models->responseStatus->responseCode == 'Successful') {
                foreach ($models->model as $model) {
                    $existingModel = Model::updateOrCreate(
                        ['division_id' => $division->id, 'number' => $model->id],
                        ['name' => $model->_]
                    );
                    $updatedModels[] = $existingModel;
                }
            }
        }

        return response()->json(['models' => $updatedModels]);
    }


    public function updateDivisions(Request $request)
    {
        $year = $request->input('year');

        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = [
            'number' => config('services.jdpower.client_id'),
            'secret' => config('services.jdpower.client_secret'),
            'country' => 'US',
            'language' => 'en'
        ];

        // Fetch divisions from the SOAP API
        $divisions = $client->getDivisions([
            'accountInfo' => $account,
            'modelYear' => $year,
        ]);

        $updatedDivisions = [];

        // Check if the API response is successful
        if (isset($divisions->responseStatus->responseCode) && $divisions->responseStatus->responseCode == 'Successful') {
            // Loop through each division from the response
            foreach ($divisions->division as $division) {
                // Check if the division already exists for the same year
                $existingRecord = Division::where('number', $division->id)
                    ->where('year', $year)
                    ->first();

                // If the division doesn't exist, create it
                if (!$existingRecord) {
                    $newDivision = Division::create([
                        'name' => $division->_,
                        'number' => $division->id,
                        'year' => $year
                    ]);

                    // Add the newly created division to the list of updated divisions
                    $updatedDivisions[] = $newDivision;
                } else {
                    $updatedDivisions[] = $existingRecord;
                }
            }
        }

        // Return the list of newly created divisions
        return response()->json(['divisions' => $updatedDivisions]);
    }

    public function updateStyles(Request $request)
    {
        $modelId = $request->input('model_id');
        $divisionId = $request->input('division_id');
        $year = $request->input('year');

        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = [
            'number' => config('services.jdpower.client_id'),
            'secret' => config('services.jdpower.client_secret'),
            'country' => 'US',
            'language' => 'en'
        ];

        $updatedStyles = [];


        if ($modelId == 'all') {
            // Fetch division IDs based on the year
            if ($divisionId == 'all') {
                // Get all division IDs for the selected year
                $divisionIds = Division::where('year', $year)->pluck('id')->toArray();
            } else {
                // Use the selected division ID
                $divisionIds = [$divisionId];
            }
            // Get all model IDs from those divisions
            $modelIds = Model::whereIn('division_id', $divisionIds)->pluck('id')->toArray();
        } else {
            // If a specific model is selected, use it
            $modelIds = [$modelId];
        }

        $models = Model::whereIn('id', $modelIds)->get();
        
        foreach ($models as $model) {
            // Fetch styles for each model
            $chromeStyles = $client->getStyles([
                'accountInfo' => $account,
                'modelId' => $model->number,
            ]);

            if (isset($chromeStyles->responseStatus->responseCode) && $chromeStyles->responseStatus->responseCode == 'Successful') {
                foreach ($chromeStyles->style as $chromeStyle) {
                    $existingStyle = Style::updateOrCreate(
                        ['model_id' => $model->id, 'number' => $chromeStyle->id],
                        ['name' => $chromeStyle->_]
                    );
                    $updatedStyles[] = $existingStyle;
                }
            }
        }
        
        return response()->json(['styles' => $updatedStyles]);
    }



    public function updateVehicles(Request $request)
    {
        // Get ChromeData API credentials from config
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number' => $usernumber, 'secret' => $secretKey, 'country' => "US", 'language' => "en"];

        $year = $request->input('year');
        $divisionId = $request->input('division_id');
        $modelId = $request->input('model_id');
        $styleIds = $request->input('style_ids');
        $limit = $request->input('vehicles_limit'); // Default to 1000
        $withImages = $request->input('with_images') == 1;  // Handle free pull (images)
        // Initialize $styles to an empty collection
        $styles = collect();

        // If "all" is selected in styles dropdown
        if (is_array($styleIds) && in_array('all', $styleIds)) {
            // Check if "all" is selected in models
            if ($modelId == 'all') {
                // Fetch division IDs based on the year
                if ($divisionId == 'all') {
                    // Get all division IDs for the selected year
                    $divisionIds = Division::where('year', $year)->pluck('id')->toArray();
                } else {
                    // Use the selected division ID
                    $divisionIds = [$divisionId];
                }
                // Get all model IDs from those divisions
                $modelIds = Model::whereIn('division_id', $divisionIds)->pluck('id')->toArray();
            } else {
                // If a specific model is selected, use it
                $modelIds = [$modelId];
            }

            // Fetch styles for the selected models, apply the limit only if it's not null
            $stylesQuery = Style::whereIn('model_id', $modelIds)->whereDump(0);
            if ($limit) {
                $stylesQuery->limit($limit);
            }
            $styles = $stylesQuery->get();
        } else {
            // Fetch specific styles based on style_ids
            $stylesQuery = Style::whereIn('id', $styleIds)->whereDump(0);
            if ($limit) {
                $stylesQuery->limit($limit);
            }
            $styles = $stylesQuery->get();
        }

        foreach ($styles as $style) {

            $cover_image = $withImages ? $this->fetchVehicleImages($style->number) : null;

            $chromdataVehicle = $client->describeVehicle([
                'accountInfo' => $account,
                'styleId' => $style->number,
                'switch' => ['ShowExtendedDescriptions', 'ShowExtendedTechnicalSpecifications', 'IncludeDefinitions', 'ShowAvailableEquipment'],
                'SwitchChromeMediaGallery' => 'Both'
            ]);

            if (isset($chromdataVehicle->responseStatus->responseCode) && $chromdataVehicle->responseStatus->responseCode == 'Successful') {

                $fuel_type = $this->createFuelType($chromdataVehicle->engine);
                $engine_type = $this->createEngineType($chromdataVehicle->engine);
                $vehicle = Vehicle::where('style_id', $style->id)->first();
                if (!$vehicle) {
                    $vehicle = Vehicle::create([
                        'style_id' => $style->id,
                        'style_number' => $style->number,
                        'engine_type_id' => $engine_type->id,
                        'fuel_type_id' => $fuel_type->id,
                        'name' => $chromdataVehicle->modelYear . ' ' . $chromdataVehicle->style->division->_ . ' ' . $chromdataVehicle->style->model->_ . ' ' . $chromdataVehicle->style->name,
                        'year' => $chromdataVehicle->modelYear,
                        'body_type' => is_array($chromdataVehicle->style->bodyType) ? $chromdataVehicle->style->bodyType[0]->_ : $chromdataVehicle->style->bodyType->_,
                        'data' => json_encode($chromdataVehicle),
                        'image' => $cover_image,
                    ]);
                }

                $this->updateVehicleWithTechnicalInfo($vehicle, $chromdataVehicle);

                // Mark style as dumped
                $style->dump = 1;
                $style->save();
            }
        }

        // Fetch and return the updated vehicles
        $vehicles = Vehicle::whereIn('style_id', $styles->pluck('id')->toArray())->get();

        return response()->json(['vehicles' => $vehicles]);
    }


    /**
     * Create fuel type for the vehicle
     */
    private function createFuelType($engine)
    {
        if (isset($engine->fuelType) && $engine->fuelType->_) {
            return FuelType::create([
                'name' => $engine->fuelType->_,
                'number' => $engine->fuelType->id,
                'economy' => isset($engine->fuelEconomy) ? json_encode($engine->fuelEconomy) : json_encode([]),
                'capacity' => isset($engine->fuelCapacity) ? json_encode($engine->fuelCapacity) : json_encode([]),
            ]);
        }
        return (object) ['id' => 0]; // Default object if no fuel type
    }

    /**
     * Create engine type for the vehicle
     */
    private function createEngineType($engine)
    {
        if (isset($engine->engineType) && $engine->engineType->_) {
            return EngineType::create([
                'name' => $engine->engineType->_,
                'number' => $engine->engineType->id,
            ]);
        }
        return (object) ['id' => 0]; // Default object if no engine type
    }

    /**
     * Fetch vehicle images from ChromeData and store them
     */
    private function fetchVehicleImages($styleNumber)
    {
        // Context for fetching images
        $context = stream_context_create([
            'http' => [
                'ignore_errors' => true,
                'header' => "Authorization: Basic " . base64_encode(config('services.jdpower.client_id') . ':' . config('services.jdpower.client_secret'))
            ]
        ]);

        // Fetch image gallery JSON
        $gallery_api = file_get_contents('http://media.chromedata.com/MediaGallery/service/style/' . $styleNumber . '.json', false, $context);
        $images = json_decode($gallery_api);

        $cover_image = '';

        if (isset($images->view[0])) {
            foreach ($images->view as $image) {
                if (in_array($image->{'@shotCode'}, ["01", "02", "03", "12"]) && $image->{'@width'} == "2100" && $image->{'@backgroundDescription'} == "White") {
                    // Log API call
                    // DB::table('api_request_logs')->insert(['request_type' => 'single_image', 'request_from' => request()->ip(), 'created_at' => now()]);

                    try {
                        $contents = file_get_contents($image->{'@href'});
                        $file_path = substr($image->{'@href'}, strrpos($image->{'@href'}, '/') + 1);
                        Storage::put('public/vehicles/' . $file_path, $contents);

                        if ($image->{'@shotCode'} == "01") {
                            $cover_image = 'storage/vehicles/' . $file_path;
                        }

                        VehicleImage::updateOrCreate(
                            [
                                'style_id' => $styleNumber,  // Search condition
                                'type' => $image->{'@shotCode'}  // Search condition
                            ],
                            [
                                'image' => 'storage/vehicles/' . $file_path,  // Fields to update/create
                                'data' => json_encode($image)
                            ]
                        );
                    } catch (\Throwable $th) {
                        // Handle image fetching errors
                    }
                }
            }
        }

        return $cover_image;
    }

    private function updateVehicleWithTechnicalInfo($vehicle, $chromdataVehicle)
    {
        $vehicle->pricing = $chromdataVehicle->style->basePrice->msrp;

        if (isset($chromdataVehicle->engine->horsepower->value)) {
            $vehicle->horsepower = $chromdataVehicle->engine->horsepower->value;
        }

        if (isset($chromdataVehicle->engine->netTorque->value)) {
            $vehicle->torque = $chromdataVehicle->engine->netTorque->value;
        }

        if (isset($chromdataVehicle->bestMakeName)) {
            $vehicle->division = $chromdataVehicle->bestMakeName;
        }

        if (isset($chromdataVehicle->bestModelName)) {
            $vehicle->model = $chromdataVehicle->bestModelName;
        }

        if (isset($chromdataVehicle->bestStyleName)) {
            $vehicle->style = $chromdataVehicle->bestStyleName;
        }

        if (isset($chromdataVehicle->engine->fuelEconomy->city->low)) {
            $vehicle->mpg_city = $chromdataVehicle->engine->fuelEconomy->city->low;
        }

        if (isset($chromdataVehicle->engine->fuelEconomy->hwy->low)) {
            $vehicle->mpg_hwy = $chromdataVehicle->engine->fuelEconomy->hwy->low;
        }

        foreach ($chromdataVehicle->technicalSpecification as $tech) {
            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Passenger Capacity') {
                $vehicle->seating = isset($tech->value->value) && $tech->value->value ? $tech->value->value : 0;
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Head Room') {
                $vehicle->front_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Head Room') {
                $vehicle->second_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Leg Room') {
                $vehicle->front_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Leg Room') {
                $vehicle->second_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Shoulder Room') {
                $vehicle->front_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Shoulder Room') {
                $vehicle->second_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Length, Overall') {
                $vehicle->length_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Height, Overall') {
                $vehicle->height_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Width, Max w/o mirrors') {
                $vehicle->width_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume with Rear Seat Up') {
                $vehicle->cargo_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume to Seat 1') {
                $vehicle->cargo_volume_to_seat_1 = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Trunk Volume') {
                $vehicle->trunk_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }

            if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Estimated Battery Range') {
                $vehicle->battery_range = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
            }
        }

        $vehicle->save();
    }
}
