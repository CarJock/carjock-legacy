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
        $division = Division::find($divisionId);

        // Fetch distinct models by their number
        $models = Model::where('division_id', $division->id)
            ->select('id', 'number', 'name') // Select only the fields you need
            ->distinct('number') // Ensure distinct by the number field
            ->get();

        return response()->json(['models' => $models]);
    }


    public function getStylesByModel(Request $request)
    {
        $modelId = $request->input('model_id');
        $styles = Style::where('model_id', $modelId)->get();

        return response()->json(['styles' => $styles]);
    }


    public function getVehiclesByStyles(Request $request)
    {
        $styleIds = $request->input('style_ids'); // Retrieve style IDs from request

        if (is_array($styleIds) && count($styleIds) > 0) {
            // Query vehicles related to the selected styles
            $vehicles = Vehicle::whereIn('style_id', $styleIds)->get(); // Assuming 'style_id' in the Vehicle model

            return response()->json(['vehicles' => $vehicles]);
        } else {
            return response()->json(['vehicles' => []], 400); // Return empty response if no styles selected
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

        // Fetch models based on division and year from ChromeData
        $division = Division::findOrFail($divisionId);
        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number' => config('services.jdpower.client_id'), 'secret' => config('services.jdpower.client_secret'), 'country' => 'US', 'language' => 'en'];

        $models = $client->getModels([
            'accountInfo' => $account,
            'modelYear' => $year,
            'divisionId' => $division->number
        ]);

        $updatedModels = [];

        if (isset($models->responseStatus->responseCode) && $models->responseStatus->responseCode == 'Successful') {
            foreach ($models->model as $model) {
                $existingModel = Model::updateOrCreate(
                    ['division_id' => $division->id, 'number' => $model->id],
                    ['name' => $model->_]
                );
                $updatedModels[] = $existingModel;
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
                $existingModel = Division::where('number', $division->id)
                    ->where('year', $year)
                    ->first();

                // If the division doesn't exist, create it
                if (!$existingModel) {
                    $newDivision = Division::create([
                        'name' => $division->_,
                        'number' => $division->id,
                        'year' => $year
                    ]);

                    // Add the newly created division to the list of updated divisions
                    $updatedDivisions[] = $newDivision;
                }
            }
        }

        // Return the list of newly created divisions
        return response()->json(['divisions' => $updatedDivisions]);
    }

    public function updateStyles(Request $request)
    {
        $model_id = $request->input('model_id');
        $model = Model::find($model_id);
        $model_number = $model->number;

        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = [
            'number' => config('services.jdpower.client_id'),
            'secret' => config('services.jdpower.client_secret'),
            'country' => 'US',
            'language' => 'en'
        ];

        $styles = $client->getStyles([
            'accountInfo' => $account,
            'modelId' => $model_number,
        ]);

        $updatedStyles = [];

        // Check if the API response is successful
        if (isset($styles->responseStatus->responseCode) && $styles->responseStatus->responseCode == 'Successful') {
            // Loop through each division from the response
            foreach ($styles->style as $style) {
                // Check if the division already exists for the same year
                $existingModel = Style::where('number', $style->id)
                    ->where('model_id', $model_id)
                    ->first();

                // If the division doesn't exist, create it
                if (!$existingModel) {
                    $newStyle = Style::create([
                        'name' => $style->_,
                        'number' => $style->id,
                        'model_id' => $model_id
                    ]);

                    // Add the newly created division to the list of updated divisions
                    $updatedStyles[] = $newStyle;
                }
            }
        }

        // Return the list of newly created divisions
        return response()->json(['styles' => $updatedStyles]);
    }


    public function updateVehicles(Request $request)
    {
        // Get ChromeData API credentials from config
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new \SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number' => $usernumber, 'secret' => $secretKey, 'country' => "US", 'language' => "en"];

        // Retrieve form data
        $styleIds = $request->input('style_ids'); // Array of style IDs
        $limit = $request->input('vehicles_limit', 1000); // Vehicle limit, default 10
        $withImages = $request->input('free_pull') == 1; // Whether to pull images

        // Fetch styles
        $styles = Style::whereIn('id', $styleIds)->get();

        foreach ($styles as $style) {
            // Log API call
            // DB::table('api_request_logs')->insert(['request_type' => 'vehicles', 'request_from' => $request->ip(), 'created_at' => now()]);
            // $api_logs = DB::table('api_request_logs')->whereMonth('created_at', date('m'))->count();

            // Stop execution if limit exceeds 1000 API calls
            // if ($api_logs > 1000) {
            //     return response()->json(['message' => 'API request limit exceeded!'], 429);
            // }
            $cover_image = $this->fetchVehicleImages($style->number);
            // Check if vehicle already exists
            $vehicle_exists = Vehicle::where('style_id', $style->id)->first();
            if (!$vehicle_exists) {
                // Call the SOAP API to fetch vehicle data
                $vehicle = $client->describeVehicle([
                    'accountInfo' => $account,
                    'styleId' => $style->number,
                    'switch' => ['ShowExtendedDescriptions', 'ShowExtendedTechnicalSpecifications', 'IncludeDefinitions', 'ShowAvailableEquipment'],
                    'SwitchChromeMediaGallery' => 'Both'
                ]);

                if (isset($vehicle->responseStatus->responseCode) && $vehicle->responseStatus->responseCode == 'Successful') {

                    $fuel_type = $this->createFuelType($vehicle->engine);
                    $engine_type = $this->createEngineType($vehicle->engine);

                    Vehicle::create([
                        'style_id' => $style->id,
                        'style_number' => $style->number,
                        'engine_type_id' => $engine_type->id,
                        'fuel_type_id' => $fuel_type->id,
                        'name' => $vehicle->modelYear . ' ' . $vehicle->style->division->_ . ' ' . $vehicle->style->model->_ . ' ' . $vehicle->style->name,
                        'year' => $vehicle->modelYear,
                        'body_type' => is_array($vehicle->style->bodyType) ? $vehicle->style->bodyType[0]->_ : $vehicle->style->bodyType->_,
                        'data' => json_encode($vehicle),
                        'image' => $cover_image,
                        // Add other fields like technical specifications, division, model, etc.
                    ]);

                    // Mark style as dumped
                    $style->dump = 1;
                    $style->save();
                }
            }
        }

        $vehicles = Vehicle::whereIn('style_id', $styleIds)->get();

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
}
