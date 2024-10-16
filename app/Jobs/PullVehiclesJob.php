<?php

namespace App\Jobs;

use App\Models\Vehicle;
use App\Models\Division;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PullVehiclesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $year;
    protected $division;
    protected $freePull;

    public function __construct($year, $division, $freePull = false)
    {
        $this->year = $year;
        $this->division = $division;
        $this->freePull = $freePull;
    }

    public function handle()
    {
        $data = [];
        Mail::send('emails.chromedata_stats', $data, function ($message) {
            $message->to('jdsofttechnologies@gmail.com')
                ->subject('ChromeData Vehicle Pull Job Completed');
        });
        // Logic for pulling vehicles from ChromeData

        // $vehiclesPulled = 0;
        // $apiCalls = 0;

        // // Assume styles are fetched based on year and division
        // $styles = DB::table('styles')->where('year', $this->year)
        //     ->where('division_id', $this->division)
        //     ->get();

        // foreach ($styles as $style) {
        //     if ($this->freePull && $vehiclesPulled >= 1000) {
        //         // If free pull and limit of 1000 reached, stop pulling
        //         break;
        //     }

        //     // Pull vehicle data from ChromeData API
        //     // Example logic for calling ChromeData API
        //     $vehicleExists = Vehicle::where('style_id', $style->id)->first();
        //     if (!$vehicleExists) {
        //         // Make ChromeData API request (assume $this->getVehicleFromAPI($style->id) pulls the vehicle)
        //         $vehicle = $this->getVehicleFromAPI($style->id);

        //         // Save vehicle to the database
        //         Vehicle::create([
        //             'style_id' => $style->id,
        //             'name' => $vehicle->name,
        //             // Add other vehicle details here
        //         ]);

        //         $vehiclesPulled++;
        //     }

        //     $apiCalls++;
        // }

        // // After the job completes, send an email with statistics
        // $this->sendStatsEmail($vehiclesPulled, $apiCalls);
    }

    protected function getVehicleFromAPI($styleId)
    {
        // Here you would implement the API request to pull the vehicle data from ChromeData.
        // This is just a placeholder.
        return (object) [
            'name' => 'Sample Vehicle',
            // Add more details as per your requirements
        ];
    }

    protected function sendStatsEmail($vehiclesPulled, $apiCalls)
    {
        $data = [
            'vehicles_pulled' => $vehiclesPulled,
            'api_calls' => $apiCalls,
        ];

        // Send the email to the user with statistics
        Mail::send('emails.chromedata_stats', $data, function ($message) {
            $message->to('admin@yourcompany.com')
                ->subject('ChromeData Vehicle Pull Job Completed');
        });
    }
}
