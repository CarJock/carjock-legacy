<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Ads;
use App\Models\Banner;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CompareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Compare the cars details.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banner = Banner::where("page_id", 2)->first();
        $garageVehicles = [];

        // Pass the garage vehicles to the view
        return view('frontend.compare', compact('banner', 'garageVehicles'));
    }

    public function getGarageVehicles(Request $request)
    {
        // Check if user is logged in
        if (auth()->check()) {
            // Get the logged-in user's ID
            $userId = auth()->id();

            // Retrieve vehicles where the type is 'garage' for the logged-in user
            $garageVehicles = DB::table('user_vehicle')
                ->where('user_id', $userId)
                ->where('type', 'garage')
                ->join('vehicles', 'vehicles.id', '=', 'user_vehicle.vehicle_id')
                ->select('vehicles.*')
                ->get();
        }

        return response()->json($garageVehicles->map(function ($uv) {
            return ['id' => $uv->id, 'text' => $uv->name];
        }));
    }



    public function searchCars(Request $request)
    {
        $search = $request->input('search'); // The search term
        $page = $request->input('page', 1);  // Current page, default to 1
        $perPage = 10; // Number of items per page

        // Use full-text search on the 'name' column
        $query = Vehicle::selectRaw("*, MATCH(name) AGAINST(? IN BOOLEAN MODE) as relevance", [$search])
            ->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$search])
            ->with('user')
            ->orderByDesc('relevance'); // Order by relevance score

        // Get the results for the current page
        $cars = $query->paginate($perPage, ['*'], 'page', $page);

        // Transform the data for select2
        $results = [
            'items' => $cars->items(),
            'hasMore' => $cars->hasMorePages()
        ];

        return response()->json($results);
    }


    public function getCarById($id)
    {
        $car = Vehicle::find($id);

        if ($car) {
            return response()->json($car);
        } else {
            return response()->json(['error' => 'Car not found'], 404);
        }
    }





    /**
     * Fetch complete detail for specific selection
     *
     * @return \Illuminate\Contracts\Support\Json
     */
    public function show($id)
    {
        return response()->json(Vehicle::with('fuel_type', 'engine_type', 'user')->findOrFail($id));
    }


    public function search(Request $request)
    {
        $page = $request->input('page');
        $query = $request->input('q');

        $perPage = 30; // Adjust as needed
        $offset = ($page - 1) * $perPage;

        // Check if the query is numeric (assumed to be an ID)
        if (is_numeric($query)) {
            $vehicles = Vehicle::where('id', $query)
                ->offset($offset)
                ->limit($perPage)
                ->get();

            $total_count = $vehicles->count();
        } else {
            $vehicles = Vehicle::where('name', 'like', '%' . $query . '%')
                ->offset($offset)
                ->limit($perPage)
                ->get();

            $total_count = Vehicle::where('name', 'like', '%' . $query . '%')->count();
        }

        $data['total_count'] = $total_count;
        $data['items'] = $vehicles;

        return response()->json($data);
    }
}
