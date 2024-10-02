<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Banner;
use App\Models\Ads;
use Illuminate\Http\Request;

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
        // Get vehicles with "2023" in their names
        $vehicles2023 = Vehicle::select('id', 'name')
            ->where('name', 'like', '%2023%')
            ->orderBy('name', 'asc')
            ->get();

        // Get vehicles with "2024" in their names
        $vehicles2024 = Vehicle::select('id', 'name')
            ->where('name', 'like', '%2024%')
            ->orderBy('name', 'asc')
            ->get();

        // Merge the collections
        $vehicles = $vehicles2024->merge($vehicles2023);
        $banner = Banner::where("page_id", 2)->first();

        return view('frontend.compare', compact('vehicles', 'banner'));
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
