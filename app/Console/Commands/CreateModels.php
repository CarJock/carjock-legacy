<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Models\Model;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SoapClient;

class CreateModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-models {--division_id=} {--year=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store models against stored divisions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number'=> $usernumber, 'secret'=> $secretKey, 'country'=>"US",    'language'=>"en"];
        
        if($this->option('division_id') && is_numeric($this->option('division_id'))){
            $division_id = $this->option('division_id');
            $division = Division::findOrFail($division_id);
            
            $models = $client->getModels([
                'accountInfo' => $account,
                'modelYear' => $division->year,
                'divisionId' => $division->number
            ]); // You will get all the models with their id e.g Corolla having ID 34382. the id will be passed in getStyles
        
            if(isset($models->responseStatus->responseCode) && $models->responseStatus->responseCode == 'Successful'){
                if(isset($models->model->_) && isset($models->model->id)){
                    $model_exists = Model::where('division_id', $division_id)->where('number', $models->model->id)->first();
                    if(!$model_exists){
                        Model::create([
                            'division_id' => $division->number,
                            'name' => $models->model->_,
                            'number' => $models->model->id,
                        ]); //after creating get vehicle detail for specific style
                    }
                } else {
                    foreach($models->model as $key => $model){
                        if(is_object($model)){
                            $model_exists = Model::where('division_id', $division->number)->where('number', $model->id)->first();
                            if(!$model_exists){
                                Model::create([
                                    'division_id' => $division->number,
                                    'name' => $model->_,
                                    'number' => $model->id,
                                ]); //after creating, get all styles for specific model
                            }
                        }
                    }
                } 
            }

            $this->info('Models imported for specific division!');
            dd('done');
        }


        $divisions = Division::when($this->option('year') && is_numeric($this->option('year')), function($query){
            $query->where('year', $this->option('year'));
        })->get();

        foreach($divisions as $division){
            // DB::table('api_request_logs')->insert(['request_type' => 'models', 'request_from' => request()->ip(), 'created_at' => now()]);
            // $api_logs = DB::table('api_request_logs')->whereMonth('created_at', date('m'))->count();

            // if($api_logs > 1000){
            //     $this->info('request limit exceed!');
            //     exit;
            // }

            $division_id = $division->id;
            $models = $client->getModels([
                'accountInfo' => $account,
                'modelYear' => $division->year,
                'divisionId' => $division->number
            ]); // You will get all the models with their id e.g Corolla having ID 34382. the id will be passed in getStyles
        
            if(isset($models->responseStatus->responseCode) && $models->responseStatus->responseCode == 'Successful'){
                if(isset($models->model->_) && isset($models->model->id)){
                    $model_exists = Model::where('division_id', $division_id)->where('number', $models->model->id)->first();
                    if(!$model_exists){
                        Model::create([
                            'division_id' => $division->number,
                            'name' => $models->model->_,
                            'number' => $models->model->id,
                        ]); //after creating get vehicle detail for specific style
                    }
                } else {
                    foreach($models->model as $key => $model){
                        if(is_object($model)){
                            $model_exists = Model::where('division_id', $division->number)->where('number', $model->id)->first();
                            if(!$model_exists){
                                Model::create([
                                    'division_id' => $division->number,
                                    'name' => $model->_,
                                    'number' => $model->id,
                                ]); //after creating, get all styles for specific model
                            }
                        }
                    }
                } 
            }
        }   
        $this->info('All styles imported.');     
    }
}
