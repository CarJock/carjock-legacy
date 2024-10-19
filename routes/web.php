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
    Route::get('account', 'UserController@index')->name('account')->middleware(['guest']);
    Route::post('vehicle/ajax/favourite', 'UserController@favourite')->name('favourite');
    Route::post('vehicle/ajax/comparisions', 'UserController@saveCompare')->name('savecomparisions');

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('search', 'HomeController@search')->name('search');
    Route::get('vehicle/{id}', 'HomeController@show')->name('vehicle');
    Route::get('ajax/query', 'HomeController@query')->name('ajax.query');
    Route::get('ajax/query/chromedata', 'UserController@query')->name('ajax.query.chromedata');
    Route::get('/api/cars', 'CompareController@searchCars');
    Route::get('/api/cars/{id}', 'CompareController@getCarById');
    Route::get('/api/garage-vehicles', 'CompareController@getGarageVehicles');



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
    Route::get('/data-deletion-instructions', function(){
        return view('data-deletion-instructions');
    })->name('data-deletion-instructions');
});