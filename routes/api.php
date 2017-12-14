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
Route::get('/getuserdetail/{id}', 'Api\v1\UserController@getUserDetail');
Route::put('/updateuser','Api\v1\UserController@updateUser');
Route::post('/updateprofile','Api\v1\UserController@updateProfile');
Route::post('/displayprofile','Api\v1\UserController@displayProfile');
Route::get('/getCityList/{country}','CityExplorer@getCity');
Route::get('/getsightseen','Api\v1\CityExplorer@sight_seen');
Route::get('/getpopularsightseen','Api\v1\CityExplorer@getPopularSightSeen');
Route::get('/getcountries','Api\v1\CityExplorer@getCountry');
Route::get('/getsightseenfromcountry','Api\v1\CityExplorer@getSightSeenFromCountry');
Route::get('/getsightseenfromcity','Api\v1\CityExplorer@getSightSeenFromCity');
Route::get('getTax','Api\v1\UserBookingController@getTax');
// booking Api's routes
Route::post('addToCart', 'Api\v1\UserBookingController@store');
Route::put('updateCart/{booking}', 'Api\v1\UserBookingController@update');
Route::get('getCartItems/{id}', 'Api\v1\UserBookingController@getCartItems');
Route::get('getCartCount/{id}','Api\v1\UserBookingController@getCartCount');
Route::delete('deleteCartItem/{id}','Api\v1\UserBookingController@deleteCartItem');
Route::get('getBookings/{id}','Api\v1\UserBookingController@getBookings');
Route::put('cancelBooking/{id}','Api\v1\UserBookingController@cancelBooking');
Route::post('payment','Api\v1\PaymentsController@charge');
//
use GuzzleHttp\Client;

Route::get('getCurrency', function(){
  $client = new Client();
  $response = $client->get('https://openexchangerates.org/api/latest.json?app_id=f5cdf62bf9e94f16bf512ec8542c255e');
  $response = json_decode((string) $response->getBody(), true);
  return response()->json(['value'=>$response['rates']['INR']],200);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
