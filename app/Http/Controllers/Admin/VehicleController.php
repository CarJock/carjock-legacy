<?php

namespace App\Http\Controllers\Admin;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index(Request $request)
    {
        return view('admin.featured-cars.index', [
            'vehicles' => Vehicle::when($request->keywords, function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->keywords . '%');
            })->when($request->featured, function ($query) use ($request) {
                return $query->where('feature', $request->featured);
            })->paginate(20),
        ]);
    }

    public function show($id)
    {
        $vehicles = Vehicle::where('id', $id)->first();
        return view('admin.featured-cars.show', ['vehicle' => $vehicles]);
    }

    public function edit($id)
    {
        $vehicles = Vehicle::where('id', $id)->first();
        return view('admin.featured-cars.edit', ['vehicle' => $vehicles]);
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        if ($vehicle->feature == 'yes') {
            $vehicle->feature = 'no';
        } else {
            $vehicle->feature = 'yes';
        }

        $vehicle->save();
        return response()->json(['message' => 'Car has been Featured successfully.']);
    }

    public function destroy($id)
    {
        $cars = Vehicle::where('id', $id)->first();
        $cars->delete();
        return back();
    }
}
