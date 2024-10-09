<?php

use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


/*All Technical Documentation

http://update.chromedata.com/
Username: 330715
Password:  837073c3
Access to Chrome Web Services

Automotive Description Service – Full

Chrome Image Gallery (Media Server) BASIC
Account Number: 330715
Account Secret: 8180db4378bf4030

For help
support@api.jdpower.com

API
http://portal.chromedata.com/enterpriseapi/
email:mkue@savvycorp.ca
pw: !95hMmGV8m6SGSj



Automotive Description Service_ Full
Click on http://update.chromedata.com/ to download all technical documentation. Provided below are the login and password credentials required to access the site.
Username: 331328
Password: 3fed45c9
Find the API description at http://services.chromedata.com/Description/7c?wsdl Provided below are important login and password credentials required to access your licensed service.
Account Number: 331328
Account Secret: a70da81837a04f31
Refer to the Developer’s Guide (see Step 1 above) for accessing the Chrome Web Services using your credentials and the webservice address (provided in the Guide).


Chrome Image Gallery (Media Server)_ Basic
Click on http://update.chromedata.com/ to download all technical documentation. See page 21 of the developer’s guide. Provided below are the login and password credentials required to access the site.
Username: 331328
Password: 3fed45c9
Provided below are important login and password credentials required to access your licensed service.
Account Number: 331328
Account Secret: a70da81837a04f31
Refer to page 21 of the Developer’s Guide (see Step 1 above) for accessing the Chrome Web Services using your credentials and the web service address (provided in the Guide).

Store division
Store Models
Store Styles
Store Vehicle information
Store Images
*/



Route::get('testing', function () {
    // Get the total count of vehicles with null tech_specs
    $total = Vehicle::whereNull('width_overall')->count();

    // Set the batch size for processing
    $batchSize = 100; // You can adjust this according to your requirements

    // Calculate the number of batches needed
    $numBatches = ceil($total / $batchSize);

    // Initialize variable to keep track of processed records
    $processedCount = 0;

    // Loop through each batch
    for ($i = 0; $i < $numBatches; $i++) {
        // Retrieve vehicles with null tech_specs in the current batch
        $vehicles = Vehicle::whereNull('width_overall')
                            ->offset($i * $batchSize)
                            ->limit($batchSize)
                            ->get();

        // Iterate over each vehicle in the current batch
        foreach ($vehicles as $vehicle) {
            // Decode the JSON stored in the 'data' column
            $techSpecs = json_decode($vehicle->tech_specs, true) ;
            if(!$techSpecs || !is_array($techSpecs))
            continue;
            foreach ($techSpecs as $key => $techSpec) {

                if ($techSpec['definition']['title']['_'] == 'Width, Max w/o mirrors') {
                    if(isset($techSpec['range'])){
                        $max = $techSpec['range']['max'];
                    }else{
                        break;
                    }
                    $vehicle->width_overall = $max;
                    $vehicle->save();
                    break;
                }

            }


            // Increment the processed count
            $processedCount++;
        }
    }

    return response()->json(['message' => 'Tech specs updated for ' . $processedCount . ' vehicles']);
});



Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'
], function () {
    Auth::Routes();
    /**FACEBOOK LOGIN */
    Route::get('/auth/facebook/redirect', function () {
        return Socialite::driver('facebook')->redirect();
    })->name('facebook.login');
    Route::get('/auth/facebook/callback', 'UserController@facebook');
    Route::get('account', 'UserController@index')->name('account');
    Route::post('vehicle/ajax/favourite', 'UserController@favourite')->name('favourite');
    Route::post('vehicle/ajax/comparisions', 'UserController@saveCompare')->name('savecomparisions');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('vehicle/{id}', 'HomeController@show')->name('vehicle');
    Route::get('ajax/query', 'HomeController@query')->name('ajax.query');
    Route::get('ajax/query/chromedata', 'UserController@query')->name('ajax.query.chromedata');

    Route::get('vehicle/ajax/{id}', 'CompareController@show')->name('vehicle.detail');
    Route::get('compare', 'CompareController@index')->name('compare');
    Route::get('forum', 'ForumController@index')->name('forum');

    /**----------------------------PAGES START ------------------------------ */
    Route::get('page/{slug}', 'PagesController@page')->name('page');
    Route::get('contact-us', 'ContactUsController@index')->name('contact');
    Route::post('contact-us', 'ContactUsController@store')->name('contact-us');
    Route::post('subscribe', 'ContactUsController@storeSubscriptions')->name('subscribe');
    Route::get('search-vehicles', 'CompareController@search')->name('search.vehcile.ajax');
    Route::get('about-us', 'PagesController@aboutUs')->name('aboutus');
    Route::get('disclaimer', 'PagesController@disclaimer')->name('disclaimer');
    Route::get('privacy-policy', 'PagesController@privacy')->name('privacy-policy');
    Route::get('term-conditions', 'PagesController@termsConditions')->name('term-conditions');
    Route::get('thankyou', 'PagesController@thankyou')->name('thankyou');
    Route::get('faqs', 'PagesController@faqs')->name('faqs');
    Route::post('ads-clicks', 'PagesController@adsClicks')->name('ads-clicks');
    /**--------------------------CONTACT US & SUBSCRIPTIONS------------------ */
    // Route::group(['prefix' => 'page'], function(){
    //     Route::get('faqs', 'PagesController@index')->name('faqs');
    //     Route::get('about-us', 'PagesController@index')->name('about');
    // });
    /**----------------------------PAGES END ------------------------------ */


    Route::group([
        'prefix' => 'account',
        'middleware' => 'auth',
        'as' => 'account.'
    ], function () {
        Route::get('profile', 'UserController@show')->name('profile');
        // Route::get('profile/edit', 'UserController@edit')->name('profile.edit');
        Route::post('profile/edit', 'UserController@update')->name('profile.update');
        Route::get('profile/change-password', 'UserController@changePassword')->name('profile.change-password');
        Route::get('profile/garage', 'UserController@garage')->name('profile.garage');
        Route::get('profile/favourites', 'UserController@favourites')->name('profile.favourites');
        Route::get('profile/comparisions', 'UserController@comparisions')->name('profile.comparisions');
        Route::get('compare/delete/{id}', 'UserController@deleteCompare')->name('compare.delete');
        Route::get('garage/delete/{id}', 'UserController@deleteFromGarage')->name('garage.delete');
    });
});

Route::group([], function(){
    Route::get('/blogs', 'BlogController@index')->name('blogs.index');
});