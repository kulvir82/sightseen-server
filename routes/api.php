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

Route::post('testnotification', function(){
	PushNotification::app('IOS')
                ->to(strToLower('A14A8379B450C843A86F13C144CEDFBE2B439142B33B394C094780D90D2048FB'))
                ->send("Your voucher for Chaophraya dinner Cruise on sic has been added");
});

Route::post('/sendsms','Api\v1\UserController@sendSms');
Route::get('/getcodebycall', 'Api\v1\UserController@getCodeByCall');
Route::get('/getuserdetail', 'Api\v1\UserController@getUserDetail');
Route::put('/updateuser','Api\v1\UserController@updateUser');
Route::put('/deleteaccount','Api\v1\UserController@deleteAccount');
Route::post('/updateprofile','Api\v1\UserController@updateProfile');
Route::post('/displayprofile','Api\v1\UserController@displayProfile');
Route::get('/getCityList','CityExplorer@getCity');
Route::get('/getsightseen','Api\v1\CityExplorer@sight_seen');
Route::get('/getpopularsightseen','Api\v1\CityExplorer@getPopularSightSeen');
Route::get('/getcountries','Api\v1\CityExplorer@getCountry');
Route::get('/getsightseenfromcountry','Api\v1\CityExplorer@getSightSeenFromCountry');
Route::get('/getsightseenfromcity','Api\v1\CityExplorer@getSightSeenFromCity');
Route::get('getTax','Api\v1\UserBookingController@getTax');
// booking Api's routes
Route::post('addToCart', 'Api\v1\UserBookingController@store');
Route::put('updateCart', 'Api\v1\UserBookingController@update');
Route::get('getCartItems', 'Api\v1\UserBookingController@getCartItems');
Route::get('getCartCount','Api\v1\UserBookingController@getCartCount');
Route::delete('deleteCartItem','Api\v1\UserBookingController@deleteCartItem');
Route::get('getBookings','Api\v1\UserBookingController@getBookings');
Route::put('cancelBooking','Api\v1\UserBookingController@cancelBooking');
Route::post('payment','Api\v1\PaymentsController@charge');
Route::post('addfeedback', 'Api\v1\FeedbacksController@store');
Route::get('feedbacks', 'Api\v1\FeedbacksController@feedbacks');
Route::post('addtoken', 'Api\v1\UserController@addDeviceToken');
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
