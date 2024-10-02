<?php

namespace App\Http\Controllers\Admin;

use App\Models\Model;
use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Validation\Rule;

class VehicleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $models = Division::groupBy('name')->paginate(50);
        return view('admin.vehicle-model.index', [
            'models' => $models
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
        // $request->validate([
        //     'link_url' => ['required', 'url'],
        // ]);
        // Find the model by ID
        $models = Division::where('name', $request->input('model_name'))->get();
        $vehicles = Vehicle::where('division', $request->input('model_name'))->get();
        foreach ($models as $key => $model) {
            // Update the link_url
            $model->link_url = $request->input('link_url');
            $model->save();
        }
        foreach ($vehicles as $key => $vehicle) {
            // Update the link_url
            $vehicle->link_url = $request->input('link_url');
            $vehicle->save();
        }

        // Add any additional logic or messages as needed

        return redirect()->back()->with('message', 'Link URL updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
