<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Jobs\PullVehiclesJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChromeDataController extends Controller
{
    public function handleJob(Request $request)
    {
        
        // Validate the request
        $request->validate([
            'year' => 'required',
            'division' => 'required',
        ]);

        $year = $request->input('year');
        $division = $request->input('division');
        $freePull = $request->input('free_pull', false); // default to false if checkbox is not checked

        // Log the job execution
        // DB::table('api_request_logs')->insert([
        //     'request_type' => 'chromedata_job',
        //     'request_from' => $request->ip(),
        //     'created_at' => now(),
        // ]);

        // If free pull checkbox is selected
        if ($freePull) {
            // Start the job to pull 1000 vehicles for the current month
            PullVehiclesJob::dispatch($year, $division, true);
        } else {
            // Start the job to pull vehicles based on the selected year and division
            PullVehiclesJob::dispatch($year, $division, false);
        }

        return back()->with(['message' => 'The vehicle pull job has been initiated successfully.', 'alert-type' => 'success']);
    }
}
