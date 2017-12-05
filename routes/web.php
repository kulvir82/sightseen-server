<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use GuzzleHttp\Client;
Route::get('getCurrency', function(){
  $client = new Client();
  $response = $client->get('https://openexchangerates.org/api/latest.json?app_id=f5cdf62bf9e94f16bf512ec8542c255e');
  $response = json_decode((string) $response->getBody(), true);
  return $response['rates']['INR'];
});


Route::get('/', function () { return view('frontview/index'); });
Route::get('/register', function () { return view('auth/register'); });

// Route::post('/register/user', [ 'as' => 'user', 'uses' => 'registerController@create']);
Route::get('/welcome',[ 'as' => 'layouts/welcome', 'uses' => 'HomeController@index']);
Route::post('/usersignin','UsersController@userLogin');
Route::post('/sendsms','UsersController@sendSms');
Auth::routes();


//admin routes
Route::group(['middleware' => 'auth'], function () {
  Route::post('/userprofile','CityExplorer@getUserProfile');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::get('/getsightseen','CityExplorer@sight_seen');
  Route::post('/getcountries','CityExplorer@getCountry');
  Route::get('/editsightseen/getCityList/{country}','CityExplorer@getCity');
  Route::get('/getCityList/{country}','CityExplorer@getCity');
  Route::post('/createsightseen','CityExplorer@createSightSeen');
  Route::get('/editsightseen','CityExplorer@getSightSeen');
  Route::post('/updatesightseen','CityExplorer@updatesight');
  Route::get('/deletesightseen/{id}','CityExplorer@delete_sight');
  Route::get('/singlesight','CityExplorer@singleSightSeen');
  Route::post('/updateimages','CityExplorer@updateImages');
  Route::post('/removeimages','CityExplorer@removeImage');
  Route::post('/refreshimages','CityExplorer@getImages');
  Route::post('/searchsightseen','CityExplorer@searchSight');
});

//user routes
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getsightseenfromcountry','CityExplorer@getSightSeenFromCountry');
Route::post('/verifypincode','UsersController@verifyPin');
Route::get('/addtocart','UsersController@addProductToUsersCart');
Route::post('/productsdata','CityExplorer@getProductDetail');
Route::get('/getPopularSightSeen', 'SightSeensController@getPopularSightSeen');
