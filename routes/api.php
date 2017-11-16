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

Route::post('/sendsms','api\v1\UserController@sendSms');
Route::post('/updateuser','api\v1\UserController@updateUser');
Route::post('/updateprofile','api\v1\UserController@updateProfile');
Route::post('/displayprofile','api\v1\UserController@displayProfile');
Route::post('/testupdateuser','api\v1\Testing@updateUser');
Route::post('/testupdateprofile','api\v1\Testing@updateProfile');
Route::post('/testdisplayprofile','api\v1\Testing@displayProfile');
Route::get('/getsightseen','api\v1\CityExplorer@sight_seen');
Route::post('/getcountries','api\v1\CityExplorer@getCountry');
Route::get('/getCityList/{country}','CityExplorer@getCity');
Route::post('/getsightseenfromcountry','api\v1\CityExplorer@getSightSeenFromCountry');
Route::post('/singlesight','CityExplorer@singleSightSeen');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
