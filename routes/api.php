<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/sendsms','Api\v1\UserController@sendSms');
Route::post('/updateuser','Api\v1\UserController@updateUser');
Route::post('/updateprofile','Api\v1\UserController@updateProfile');
Route::post('/displayprofile','Api\v1\UserController@displayProfile');
Route::get('/getsightseen','Api\v1\CityExplorer@sight_seen');
Route::post('/getcountries','Api\v1\CityExplorer@getCountry');
Route::get('/getCityList/{country}','CityExplorer@getCity');
Route::post('/getsightseenfromcountry','Api\v1\CityExplorer@getSightSeenFromCountry');
Route::get('/getsightseenfromcity','Api\v1\CityExplorer@getSightSeenFromCity');
Route::post('/singlesight','CityExplorer@singleSightSeen');

// booing Api's routes
Route::post('userbookings', 'Api\v1\UserBookingController@store');
Route::put('updateCart/{booking}', 'Api\v1\UserBookingController@update');
Route::get('getCartItems/{id}', 'Api\v1\UserBookingController@getCartItems');
Route::get('getCartCount/{id}','Api\v1\UserBookingController@getCartCount');
Route::delete('deleteCartItem/{id}','Api\v1\UserBookingController@deleteCartItem');
//
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
