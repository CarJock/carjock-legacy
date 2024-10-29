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
        $garageVehicles = collect([]);
        if (auth()->check()) {
            $userId = auth()->id();
            $garageVehicles = DB::table('user_vehicle')
                ->where('user_id', $userId)
                ->where('type', 'garage')
                ->join('vehicles', 'vehicles.id', '=', 'user_vehicle.vehicle_id')
                ->select('vehicles.id', 'vehicles.name', 'vehicles.data', 'vehicles.image')
                ->get();
        }

        return response()->json($garageVehicles->map(function ($uv) {
            return [
                'id' => $uv->id,
                'name' => $uv->name,
                'note' => 'My Garage Item',
                'image' => $uv->image,
                'data' => json_decode($uv->data, true)
            ];
        }));
    }

    public function searchCars(Request $request)
    {
        $search = $request->input('search');
        $page = $request->input('page', 1);
        $perPage = 50;

        // Attempt to extract a year (four-digit number) from the search term
        preg_match('/\b(19|20)\d{2}\b/', $search, $yearMatch);
        $year = $yearMatch[0] ?? null;

        // Build the query with full-text search and prioritize by year
        $query = Vehicle::selectRaw("*, MATCH(name) AGAINST(? IN BOOLEAN MODE) as relevance", [$search])
            ->whereRaw("MATCH(name) AGAINST(? IN BOOLEAN MODE)", [$search])
            ->with('user')
            ->when($year, function ($query) use ($year) {
                // Filter results to the extracted year if a year is found
                return $query->where('year', $year);
            }, function ($query) {
                // Otherwise, order by year in descending order
                return $query->orderBy('year', 'desc');
            })
            ->orderByDesc('relevance');

        // Paginate and transform results for select2
        $cars = $query->paginate($perPage, ['*'], 'page', $page);

        $results = [
            'items' => $cars->map(function ($car) {
                return [
                    'id' => $car->id,
                    'name' => $car->name,
                    'image' => $car->image,
                    'data' => $car->data, // Decode the `data` field
                ];
            }),
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
