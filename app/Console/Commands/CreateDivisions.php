<?php

namespace App\Console\Commands;

use App\Models\Division;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SoapClient;

class CreateDivisions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-divisions {year=2024}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Storing chromedata divisions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number'=> $usernumber, 'secret'=> $secretKey, 'country'=>"US",    'language'=>"en"];
        
        // DB::table('api_request_logs')->insert(['request_type' => 'divisions', 'request_from' => request()->ip(), 'created_at' => now()]);
        // $api_logs = DB::table('api_request_logs')->whereMonth('created_at', date('m'))->count();

        // if($api_logs > 1000){
        //     $this->info('request limit exceed!');
        //     exit;
        // }

        $divisions = $client->getDivisions([
            'accountInfo' => $account,
            'modelYear' => $this->argument('year')
        ]); //You will get all the divisions e.g toyota, honda with their ID's that will be passed in getModels
    
        if(isset($divisions->responseStatus->responseCode) && $divisions->responseStatus->responseCode == 'Successful'){
            foreach($divisions->division as $division){
        
                $division_exists = Division::where('name', $division->_)->where('number', $division->id)->where('year', $this->argument('year'))->first();
                if(!$division_exists){
                    Division::create([
                        'name' => $division->_,
                        'number' => $division->id,
                        'year' => $this->argument('year')
                    ]); //after creating get all models for specific division
                }
            }
        }

        $this->info('All divisions imported!');


        /*$years = [date('Y'), date('Y') - 1];
        foreach($years as $year){
            $divisions = $client->getDivisions([
                'accountInfo' => $account,
                'modelYear' => $year
            ]); //You will get all the divisions e.g toyota, honda with their ID's that will be passed in getModels
        
            if(isset($divisions->responseStatus->responseCode) && $divisions->responseStatus->responseCode == 'Successful'){
                foreach($divisions->division as $division){
            
                    $division_exists = Division::where('name', $division->_)->where('number', $division->id)->where('year', $year)->first();
                    if(!$division_exists){
                        Division::create([
                            'name' => $division->_,
                            'number' => $division->id,
                            'year' => $year
                        ]); //after creating get all models for specific division
                    }
                }
            }
        }
        
        $this->info('All divisions imported!');*/
    }
}
