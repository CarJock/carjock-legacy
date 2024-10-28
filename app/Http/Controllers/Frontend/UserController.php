<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\EngineType;
use App\Models\FuelType;
use App\Models\User;
use App\Models\UserCompare;
use App\Models\Vehicle;
use App\Models\VehicleImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use App\Models\PageContent;
use SoapClient;
use App\Models\Banner;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $usernumber;
    protected $secretKey;
    protected $client;
    protected $account;

    public function __construct()
    {
        $this->usernumber = config('services.jdpower.client_id');
        $this->secretKey = config('services.jdpower.client_secret');
        $this->client = null;
        $this->client = new SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $this->account = ['number' => $this->usernumber, 'secret' => $this->secretKey, 'country' => "US", 'language' => "en"];
    }

    /**
     * display default login register
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner = Banner::where("page_id", 4)->first();
        return view('frontend.auth.login-register', ["banner" => $banner]);
    }

    /**
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function show()
    {
        $user = auth()->user();
        return view('frontend.auth.account', [
            'user' => $user,
            'vehicles' => $user->vehicles,
            'compares' => new UserCompare()
        ]);
    }

    /**
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function favourites()
    {
        $user = auth()->user();
        $page_content = PageContent::where("page_id", 14)->first();
        return view('frontend.auth.favourites', [
            'user' => $user,
            'vehicles' => $user->vehicles,
            'page_content' => $page_content
        ]);
    }

    /**
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function garage()
    {
        $user = auth()->user();
        $page_content = PageContent::where("page_id", 13)->first();
        // dd($this->client->__getFunctions());
        $years = $this->client->getModelYears(['accountInfo' => $this->account])->modelYear;
        $years = array_reverse($years);
        unset($years[42]);
        unset($years[43]);
        unset($years[44]);
        return view('frontend.auth.garage', [
            'user' => $user,
            'garage' => $user->garage,
            'years' => $years,
            'page_content' => $page_content
        ]);
    }

    /**
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function comparisions()
    {
        return view('frontend.auth.comparisions', [
            'user' => auth()->user(),
            'compares' => UserCompare::where('user_id', auth()->user()->id)->get(),
            'page_content' => PageContent::where("page_id", 15)->first(),
        ]);
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(auth()->user()->id);

        $request->validate([
            'username' => $request->old_password ? 'required|string|regex:/^[a-zA-Z0-9\-\.\_]+$/|max:255|unique:users,username,' . $user->id : 'nullable',
            'firstname' => $request->old_password ? ['required', 'string', 'max:255'] : ['nullable'],
            'lastname' => $request->old_password ? ['nullable', 'string', 'max:255'] : ['nullable'],
            'password' => $request->old_password ? ['required', 'string', 'min:8', 'confirmed', 'different:old_password'] : ['nullable'],
            'image' => 'sometimes|image|mimes:jpg,jpeg,png',
            'city' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ], [
            'username.regex' => 'The username field must only contain letters, numbers, dashes, dot, and underscores.'
        ]);

        if ($request->old_password && !Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->with('error', 'Current password does not match with our system');
        }

        // Update fields
        $user->username = $request->username ?? $user->username;
        $user->firstname = $request->firstname ?? $user->firstname;
        $user->lastname = $request->lastname ?? $user->lastname;
        $user->city = $request->city;
        $user->country = $request->country;

        if ($request->has('image')) {
            $user->image = $request->file('image')->storeAs('user', uniqid() . '.' . $request->file('image')->getClientOriginalExtension(), 'public');
        }

        if ($request->old_password) {
            $user->password = bcrypt($request->password);
        }

        $user->is_subscribed = $request->has('is_subscribed') ? 1 : 0;

        $user->save();

        return redirect()->back()->with('message', $request->old_password ? 'Password updated successfully!' : 'Profile updated successfully!');
    }


    /**
     * Change password route
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        $user = auth()->user();
        $page_content = PageContent::where("page_id", 16)->first();
        return view('frontend.auth.change-password', [
            'user' => $user,
            'page_content' => $page_content,
        ]);
    }


    /**
     * Edit user profile
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit()
    {
        return view('frontend.auth.edit-profile', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * create user from facebook
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function facebook()
    {
        $facebook_user = Socialite::driver('facebook')->fields([
            'name',
            'first_name',
            'last_name',
            'email',
            'gender',
            'verified'
        ])->user();

        if ($user = User::where('email', $facebook_user->email)->first()) {
            $user->facebook_id = $facebook_user->id;
            // $user->image = $facebook_user->avatar;
            $user->facebook_token = $facebook_user->token;
            $user->save();
        } else {
            $user = User::create([
                'name' => $facebook_user->name,
                'firstname' => $facebook_user->user['first_name'],
                'lastname' => $facebook_user->user['last_name'],
                'email' => $facebook_user->email,
                'image' => $facebook_user->avatar,
                'facebook_token' => $facebook_user->token,
                'facebook_refresh_token' => $facebook_user->refreshToken,
            ]);
        }

        Auth::login($user);
        return redirect()->route('frontend.account.profile');
    }

    /**
     * Save vehicle as favourite and display on profile my garage
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function favourite(Request $request)
    {
        $request->validate([
            'vehicle_id' => ['required', 'numeric', 'exists:vehicles,id'],
            // 'user_id' => ['required', 'numeric', 'exists:users,id']
        ]);

        // if($request->user()->id != $request->user_id)
        //     return response()->json(['error' => 'Invalid vehicle and user information']);

        if ($request->type == 'garage') {
            if ($request->user()->garage()->count() < 3) {
                $request->user()->garage()->attach($request->vehicle_id, ['type' => 'garage']);
                return response()->json(['success' => 'Vehicle added in the garage successfully.', 'vehicle_id' => $request->vehicle_id]);
            } else {
                return response()->json(['error' => 'You can only add 3 vehicles in the garage.']);
            }
        }

        $favourite_vehicle = $request->user()->vehicles()->where('vehicle_id', $request->vehicle_id);
        if ($favourite_vehicle->count() < 1) {
            $request->user()->vehicles()->attach($request->vehicle_id);
            return response()->json(['success' => 'Vehicle marked favourite successfully.']);
        } else {
            $request->user()->vehicles()->wherePivot('type', '=', 'favourite')->detach($request->vehicle_id);
            return response()->json(['success' => 'Vehicle removed from favourite successfully.']);
        }
    }

    /**
     * Save comparisions.
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function saveCompare(Request $request)
    {
        $request->validate([
            'vehicle_ids' => ['required', 'array'],
        ]);

        $user_compare = new UserCompare();
        $user_compare->user_id = $request->user()->id;
        $user_compare->vehicle_ids = implode(',', $request->vehicle_ids);
        $user_compare->save();

        return response()->json(['success' => 'your compared vehicles saved.']);
    }

    /**
     * delete comparisions.
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function deleteCompare(Request $request, $id)
    {
        $user_compare = UserCompare::findOrFail($id);
        $user_compare->delete();

        return redirect()->route('frontend.account.profile.comparisions');
    }

    /**
     * delete comparisions.
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function deleteFromGarage(Request $request, $id)
    {
        $request->user()->garage()->wherePivot('type', '=', 'garage')->detach($id);
        return redirect()->route('frontend.account.profile.garage');
    }

    /**
     * Ajax Query
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function query()
    {
        if (request()->has('type') && request()->has('value')) {
            $type = request()->type;
            $value = request()->value;
            $year = request()->year;
            if ($type == 'year') {
                $divisions = $this->client->getDivisions([
                    'accountInfo' => $this->account,
                    'modelYear' => $value
                ]); //You will get all the divisions e.g toyota, honda with their ID's that will be passed in getModels

                if (isset($divisions->responseStatus->responseCode) && $divisions->responseStatus->responseCode == 'Successful') {
                    return [
                        'type' => 'division',
                        'data' => $divisions->division
                    ];
                    exit;
                }
            } else if ($type == 'make') {
                $models = $this->client->getModels([
                    'accountInfo' => $this->account,
                    'modelYear' => $year,
                    'divisionId' => $value
                ]); // You will get all the models with their id e.g Corolla having ID 34382. the id will be passed in getStyles

                if (isset($models->responseStatus->responseCode) && $models->responseStatus->responseCode == 'Successful') {
                    return [
                        'type' => 'model',
                        'data' => $models->model
                    ];
                    exit;
                }
            } else if ($type == 'model') {
                //Insert IMAGES
                $context = stream_context_create(array(
                    'http' => array(
                        'ignore_errors' => true,
                        'header'  => "Authorization: Basic " . base64_encode("$this->usernumber:$this->secretKey")
                    )
                ));

                $styles = $this->client->getStyles([
                    'accountInfo' => $this->account,
                    'modelId' => $value,
                ]); //You will get all the styles relates to corolla and their varitions. The style ID will be passed in describe model 420816

                $vehicles = collect([]);
                if (isset($styles->responseStatus->responseCode) && $styles->responseStatus->responseCode == 'Successful') {
                    if (isset($styles->style->_) && isset($styles->style->id)) {
                        $vehicle = $this->client->describeVehicle([
                            'accountInfo' => $this->account,
                            'styleId' => $styles->style->id,
                            'switch' => ['ShowExtendedDescriptions', 'ShowExtendedTechnicalSpecifications', 'IncludeDefinitions', 'ShowAvailableEquipment'],
                            'SwitchChromeMediaGallery' => 'Both'
                        ]);

                        if (isset($vehicle->responseStatus->responseCode) && $vehicle->responseStatus->responseCode == 'Successful') {
                            $fuel_type = (object) ['id' => 0];
                            $engine_type = (object) ['id' => 0];
                            if (isset($vehicle->engine->fuelType) && $vehicle->engine->fuelType->_) {
                                $fuel_type = FuelType::create([
                                    'name' => $vehicle->engine->fuelType->_,
                                    'number' => $vehicle->engine->fuelType->id,
                                    'economy' => isset($vehicle->engine->fuelEconomy) ? json_encode($vehicle->engine->fuelEconomy) : json_encode([]),
                                    'capacity' => isset($vehicle->engine->fuelCapacity) ? json_encode($vehicle->engine->fuelCapacity) : json_encode([]),
                                ]);
                            }

                            if (isset($vehicle->engine->engineType) && $vehicle->engine->engineType->_) {
                                $engine_type = EngineType::create([
                                    'name' => $vehicle->engine->engineType->_,
                                    'number' => $vehicle->engine->engineType->id,
                                ]);
                            }

                            //Insert IMAGES
                            //http://media.chromedata.com/MediaGallery/media/MzMxMzI4Xk1lZGlhIEdhbGxlcnk/yFFqSZVnygQBiGCNvT8RfuT-KeCq6JSat_iSSzDYkLSAfUgU3XFVOTFhbHGBpuFt83TWEBofh5venNoO8BJYwGQEgumVRGsqlxFAgCHEz1D3V3W4UCNLYYSpqLqzQyfAQHqqovZ31ZCvWGEOTsc5MOZJjDrzjQ3NGEJOeTj1-rM/2024FOS090035_2100_01.jpg
                            $gallery_api = file_get_contents('http://media.chromedata.com/MediaGallery/service/style/' . $styles->style->id . '.json', false, $context);
                            //Another API called for images
                            DB::table('api_request_logs')->insert(['request_type' => 'images', 'request_from' => request()->ip(), 'created_at' => now()]);

                            $images = json_decode($gallery_api);
                            $cover_image = '';
                            if (isset($images->view[0])) {
                                foreach ($images->view as $image) {
                                    //Full dash 12
                                    //Front Facing to left 1
                                    //Rear Facing to right 2
                                    if (isset($image->{'@shotCode'}) && ($image->{'@shotCode'} == "01" || $image->{'@shotCode'} == "02" || $image->{'@shotCode'} == "12") && $image->{'@width'} == "2100" && $image->{'@backgroundDescription'} == "White") {
                                        //Another API called for images
                                        DB::table('api_request_logs')->insert(['request_type' => 'single_image', 'request_from' => request()->ip(), 'created_at' => now()]);
                                        try {
                                            $contents = file_get_contents($image->{'@href'});
                                            $file_path = substr($image->{'@href'}, strrpos($image->{'@href'}, '/') + 1);
                                            Storage::put('public/vehicles/' . $file_path, $contents);

                                            if ($image->{'@shotCode'} == "01")
                                                $cover_image = 'storage/vehicles/' . $file_path;

                                            $vehicle_image = new VehicleImage();
                                            $vehicle_image->style_id = $styles->style->id;
                                            $vehicle_image->image = 'storage/vehicles/' . $file_path;
                                            $vehicle_image->type = $image->{'@shotCode'};
                                            $vehicle_image->data = json_encode($image);
                                            $vehicle_image->save();
                                        } catch (\Throwable $th) {
                                            //throw $th;
                                        }
                                    }
                                }
                            }

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
                            $seating = '';
                            if (isset($vehicle->technicalSpecification)) {
                                foreach ($vehicle->technicalSpecification as $tech) {


                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Head Room') {
                                        $front_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Head Room') {
                                        $second_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Leg Room') {
                                        $front_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Leg Room') {
                                        $second_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Shoulder Room') {
                                        $front_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Shoulder Room') {
                                        $second_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Length, Overall') {
                                        $length_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Height, Overall') {
                                        $height_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume with Rear Seat Up') {
                                        $cargo_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Trunk Volume') {
                                        $trunk_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Estimated Battery Range') {
                                        $battery_range = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                    }

                                    if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Passenger Capacity') {
                                        $seating = isset($tech->value->value) && $tech->value->value ? $tech->value->value : 0;
                                    }
                                }
                            }

                            $vehicle_id = Vehicle::create([
                                'style_id' => $styles->style->id,
                                'engine_type_id' => $engine_type->id,
                                'fuel_type_id' => $fuel_type->id,
                                'name' => $vehicle->modelYear . ' ' . $vehicle->style->division->_ . ' ' . $vehicle->style->model->_ . ' ' . $vehicle->style->name,
                                'body_type' => isset($vehicle->style->bodyType) ? (is_array($vehicle->style->bodyType) ? $vehicle->style->bodyType[0]->_ : $vehicle->style->bodyType->_) : null,
                                'data' => json_encode($vehicle),
                                // 'image' => $images['@href']
                                'image' => $cover_image,
                                'pricing' => $vehicle->style->basePrice->msrp,

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
                                'seating' => $seating,
                                'garage' => 1
                            ]);

                            $vehicles->push($vehicle_id);
                        }
                    } else {
                        foreach ($styles->style as $style) {
                            $vehicle = $this->client->describeVehicle([
                                'accountInfo' => $this->account,
                                'styleId' => $style->id,
                                'switch' => ['ShowExtendedDescriptions', 'ShowExtendedTechnicalSpecifications', 'IncludeDefinitions', 'ShowAvailableEquipment'],
                                'SwitchChromeMediaGallery' => 'Both'
                            ]);

                            if (isset($vehicle->responseStatus->responseCode) && $vehicle->responseStatus->responseCode == 'Successful') {
                                $fuel_type = (object) ['id' => 0];
                                $engine_type = (object) ['id' => 0];
                                if (isset($vehicle->engine->fuelType) && $vehicle->engine->fuelType->_) {
                                    $fuel_type = FuelType::create([
                                        'name' => $vehicle->engine->fuelType->_,
                                        'number' => $vehicle->engine->fuelType->id,
                                        'economy' => isset($vehicle->engine->fuelEconomy) ? json_encode($vehicle->engine->fuelEconomy) : json_encode([]),
                                        'capacity' => isset($vehicle->engine->fuelCapacity) ? json_encode($vehicle->engine->fuelCapacity) : json_encode([]),
                                    ]);
                                }

                                if (isset($vehicle->engine->engineType) && $vehicle->engine->engineType->_) {
                                    $engine_type = EngineType::create([
                                        'name' => $vehicle->engine->engineType->_,
                                        'number' => $vehicle->engine->engineType->id,
                                    ]);
                                }

                                //http://media.chromedata.com/MediaGallery/media/MzMxMzI4Xk1lZGlhIEdhbGxlcnk/yFFqSZVnygQBiGCNvT8RfuT-KeCq6JSat_iSSzDYkLSAfUgU3XFVOTFhbHGBpuFt83TWEBofh5venNoO8BJYwGQEgumVRGsqlxFAgCHEz1D3V3W4UCNLYYSpqLqzQyfAQHqqovZ31ZCvWGEOTsc5MOZJjDrzjQ3NGEJOeTj1-rM/2024FOS090035_2100_01.jpg
                                $gallery_api = file_get_contents('http://media.chromedata.com/MediaGallery/service/style/' . $style->id . '.json', false, $context);
                                //Another API called for images
                                DB::table('api_request_logs')->insert(['request_type' => 'images', 'request_from' => request()->ip(), 'created_at' => now()]);

                                $images = json_decode($gallery_api);
                                $cover_image = '';
                                if (isset($images->view[0])) {
                                    foreach ($images->view as $image) {
                                        //Full dash 12
                                        //Front Facing to left 1
                                        //Rear Facing to right 2
                                        if (isset($image->{'@shotCode'}) && ($image->{'@shotCode'} == "01" || $image->{'@shotCode'} == "02" || $image->{'@shotCode'} == "12") && $image->{'@width'} == "2100" && $image->{'@backgroundDescription'} == "White") {
                                            //Another API called for images
                                            DB::table('api_request_logs')->insert(['request_type' => 'single_image', 'request_from' => request()->ip(), 'created_at' => now()]);
                                            try {
                                                $contents = file_get_contents($image->{'@href'});
                                                $file_path = substr($image->{'@href'}, strrpos($image->{'@href'}, '/') + 1);
                                                Storage::put('public/vehicles/' . $file_path, $contents);

                                                if ($image->{'@shotCode'} == "01")
                                                    $cover_image = 'storage/vehicles/' . $file_path;

                                                $vehicle_image = new VehicleImage();
                                                $vehicle_image->style_id = $style->id;
                                                $vehicle_image->image = 'storage/vehicles/' . $file_path;
                                                $vehicle_image->type = $image->{'@shotCode'};
                                                $vehicle_image->data = json_encode($image);
                                                $vehicle_image->save();
                                            } catch (\Throwable $th) {
                                                //throw $th;
                                            }
                                        }
                                    }
                                }

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
                                $seating = '';
                                if (isset($vehicle->technicalSpecification)) {
                                    foreach ($vehicle->technicalSpecification as $tech) {
                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Head Room') {
                                            $front_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Head Room') {
                                            $second_head_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Leg Room') {
                                            $front_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Leg Room') {
                                            $second_leg_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Front Shoulder Room') {
                                            $front_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Second Shoulder Room') {
                                            $second_shoulder_room = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Length, Overall') {
                                            $length_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Height, Overall') {
                                            $height_overall = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Cargo Volume with Rear Seat Up') {
                                            $cargo_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Trunk Volume') {
                                            $trunk_volume = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Estimated Battery Range') {
                                            $battery_range = isset($tech->value->value) && $tech->value->value ? $tech->value->value : (isset($tech->range) && isset($tech->range->max) ? $tech->range->max : null);
                                        }

                                        if (isset($tech->definition->title->_) && $tech->definition->title->_ === 'Passenger Capacity') {
                                            $seating = isset($tech->value->value) && $tech->value->value ? $tech->value->value : 0;
                                        }
                                    }
                                }

                                $vehicle_id = Vehicle::create([
                                    'style_id' => $style->id,
                                    'engine_type_id' => $engine_type->id,
                                    'fuel_type_id' => $fuel_type->id,
                                    'name' => $vehicle->modelYear . ' ' . $vehicle->style->division->_ . ' ' . $vehicle->style->model->_ . ' ' . $vehicle->style->name,
                                    'body_type' => isset($vehicle->style->bodyType) ? (is_array($vehicle->style->bodyType) ? $vehicle->style->bodyType[0]->_ : $vehicle->style->bodyType->_) : null,
                                    'data' => json_encode($vehicle),
                                    // 'image' => $images['@href']
                                    'image' => $cover_image,
                                    'pricing' => $vehicle->style->basePrice->msrp,

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
                                    'seating' => $seating,
                                    'garage' => 1
                                ]);

                                $vehicles->push($vehicle_id);
                            }
                        }
                    }

                    return [
                        'type' => 'vehicle',
                        'data' => $vehicles,
                    ];
                    exit;
                }
            }
        }
    }
}
