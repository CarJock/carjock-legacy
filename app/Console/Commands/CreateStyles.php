<?php

namespace App\Console\Commands;

use App\Models\Model;
use App\Models\Style;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use SoapClient;

class CreateStyles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-styles {--model_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store the styles after storing all the model for the division';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $usernumber = config('services.jdpower.client_id');
        $secretKey = config('services.jdpower.client_secret');
        $client = new SoapClient('http://services.chromedata.com/Description/7c?wsdl');
        $account = ['number'=> $usernumber, 'secret'=> $secretKey, 'country'=>"US",    'language'=>"en"];
        
        if($this->option('model_id') && is_numeric($this->option('model_id'))){
            $model_id = $this->option('model_id');
            $model = Model::findOrFail($model_id);
            $model_number = $model->number;
            $styles = $client->getStyles([
                'accountInfo' => $account,
                'modelId' => $model_number,
            ]); //You will get all the styles relates to corolla and their varitions. The style ID will be passed in describe model 420816
        
            if(isset($styles->responseStatus->responseCode) && $styles->responseStatus->responseCode == 'Successful'){
                if(isset($styles->style->_) && isset($styles->style->id)){
                    $style_exists = Style::where('model_id', $model_id)->where('number', $styles->style->id)->first();
                    if(!$style_exists){
                        Style::create([
                            'model_id' => $model_id,
                            'name' => $styles->style->_,
                            'number' => $styles->style->id,
                        ]); //after creating get vehicle detail for specific style
                    }
                } else {
                    foreach($styles->style as $key => $style){
                        $style_exists = Style::where('number', $model_id)->first();
                        if(is_object($style)){
                            Style::create([
                                'model_id' => $model_id,
                                'name' => $style->_,
                                'number' => $style->id,
                            ]); //after creating get vehicle detail for specific style
                        }
                    }
                } 
            }

            $this->info('Styles imported for specific division!');
            dd('done');
        }

        $models = Model::where('dump', 0)->get();
        foreach($models as $model){
            // DB::table('api_request_logs')->insert(['request_type' => 'styles', 'request_from' => request()->ip(), 'created_at' => now()]);
            // $api_logs = DB::table('api_request_logs')->whereMonth('created_at', date('m'))->count();

            // if($api_logs > 1000){
            //     $this->info('request limit exceed!');
            //     exit;
            // }
            
            $model_id = $model->id;
            //Getting Styles
            $styles = $client->getStyles([
                'accountInfo' => $account,
                'modelId' => $model->number,
            ]); //You will get all the styles relates to corolla and their varitions. The style ID will be passed in describe model 420816
        
            if(isset($styles->responseStatus->responseCode) && $styles->responseStatus->responseCode == 'Successful'){
                if(isset($styles->style->_) && isset($styles->style->id)){
                    $style_exists = Style::where('model_id', $model_id)->where('number', $styles->style->id)->first();
                    if(!$style_exists){
                        Style::create([
                            'model_id' => $model_id,
                            'name' => $styles->style->_,
                            'number' => $styles->style->id,
                        ]); //after creating get vehicle detail for specific style
                    }
                } else {
                    foreach($styles->style as $key => $style){
                        $style_exists = Style::where('number', $model_id)->where('number', $style->id)->first();
                        if(is_object($style)){
                            Style::create([
                                'model_id' => $model_id,
                                'name' => $style->_,
                                'number' => $style->id,
                            ]); //after creating get vehicle detail for specific style
                        }
                    }
                } 
            }
        }

        $this->info('All styles imported.'); 
    }
}
