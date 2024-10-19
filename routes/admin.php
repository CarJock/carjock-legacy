<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::Routes(['register' => false]);

Route::group([
    'as' => 'admin.',
    'middleware' => 'auth',
], function () {
    Route::get('/', 'DashboardController@index');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::resource('user', UserManagementController::class);
    Route::resource('subscription', SubscriptionController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('contact', ContactUsController::class);
    Route::resource('social/media', SocialMediaLinksController::class);
    Route::resource('banners', BannersController::class);
    Route::resource('metaTags', MetaTagsController::class);
    Route::resource('contents', ContentController::class);
    Route::resource('ads', AdsController::class);
    Route::resource('adslogs', AdsLogsController::class);
    Route::get('contact_exportcsv', 'ContactUsController@exportCSV')->name('contact_exportcsv');
    Route::get('subscription_exportcsv', 'SubscriptionController@exportCSV')->name('subscription_exportcsv');
    Route::get('delete_all_subs', 'SubscriptionController@deleteAll')->name('delete_all_subs');
    Route::get('setting', 'SettingController@create')->name('setting.show');
    Route::post('setting', 'SettingController@store')->name('setting.store');
    Route::get('/vehicle-model', 'VehicleModelController@index')->name('vehicle-model.index');
    Route::get('/vehicle-model/{id}', 'VehicleModelController@edit')->name('vehicle-model.edit');
    Route::patch('/vehicle-model', 'VehicleModelController@update')->name('vehicle-model.update');
    Route::delete('/vehicle-model/{id}', 'VehicleModelController@destroy')->name('vehicle-model.destroy');
    Route::post('/chromedata/jobs', 'ChromeDataController@handleJob')->name('chromedata.job');

    Route::get('/api/divisions', 'ChromeDataController@getDivisionsByYear');
    Route::get('/api/models', 'ChromeDataController@getModelsByDivision');
    Route::get('/api/styles', 'ChromeDataController@getStylesByModel');
    Route::get('/api/vehicles', 'ChromeDataController@getVehiclesByStyles');
    Route::post('/api/update-divisions', 'ChromeDataController@updateDivisions');
    Route::post('/api/update-models', 'ChromeDataController@updateModels');
    Route::post('/api/update-styles', 'ChromeDataController@updateStyles');
    Route::post('/api/update-vehicles', 'ChromeDataController@updateVehicles');
});
