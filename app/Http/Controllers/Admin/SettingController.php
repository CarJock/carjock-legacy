<?php

namespace App\Http\Controllers\Admin;

use App\Models\Model;
use App\Models\Style;
use App\Models\Setting;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.setting.index', [
            'setting' => Setting::all(),
            'divisions' => Division::all(),
            'models' => null,
            'styles' => null,
            'selectedDivisionName' => null,
            'selectedModelName' => null,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::where('meta_key', 'vehicle_detail_icons')->first();
        if ($setting) {
            $setting->update(['meta_value' => $request->vehicle_detail_icons]);
        } else {
            Setting::create([
                'meta_key'   => 'vehicle_detail_icons',
                'meta_value' => $request->vehicle_detail_icons,
            ]);
        }

        return redirect()->back()->with('message', 'Setting updated successfully');
    }
}
