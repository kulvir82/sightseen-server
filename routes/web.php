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

Route::get('/', function () { return view('frontview/index'); });
Route::get('/register', function () { return view('auth/register'); });

// Route::post('/register/user', [ 'as' => 'user', 'uses' => 'registerController@create']);
Route::get('/welcome',[ 'as' => 'layouts/welcome', 'uses' => 'HomeController@index']);
Route::post('/usersignin','UsersController@userLogin');
Route::post('/sendsms','UsersController@sendSms');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getsightseenfromcountry','CityExplorer@getSightSeenFromCountry');
Route::post('/verifypincode','UsersController@verifyPin');
Route::get('/addtocart','UsersController@addProductToUsersCart');
Route::post('/productsdata','CityExplorer@getProductDetail');

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
// Route::get('/sightseen',[ 'as' => 'sight_seen', 'uses' =>  'CityExplorer@sight_seen']);
// Route::get('/getcounty',[ 'as' => 'getcountry', 'uses' =>  'CityExplorer@getCountry']);
// Route::get('/getCityList',[ 'as' => 'getCityList', 'uses' =>  'CityExplorer@getCity']);
// Route::get('/cityList',[ 'as' => 'cityList', 'uses' =>  'CityExplorer@citiesForEditPage']);
// Route::post('/getSightSeen', [ 'as' => 'getSightSeen', 'uses' => 'CityExplorer@sight_seen']);
// Route::get('/addSightSeen',[ 'as' => 'add_ce_sightseen', 'uses' =>  'CityExplorer@addCountry']);
// Route::post('/saveSightSeen',[ 'as' => 'saveSightSeen', 'uses' =>  'CityExplorer@add_sight']);
// Route::get('/editSightSeen/{id}',[ 'as' => 'edit_ce_sightseen', 'uses' =>  'CityExplorer@editsight']);
// Route::post('/updateSightSeen',[ 'as' => 'updateSightSeen', 'uses' =>  'CityExplorer@updatesight']);
// Route::gete('/deleteSightSeen/{id}',[ 'as' => 'deleteSightSeen', 'uses' =>  'CityExplorer@delete_sight']);
// Route::get('/viewSingleSight/{id}',[ 'as' => 'single_Sight', 'uses' =>  'CityExplorer@viewsight']);
// Route::post('/searchSightSeen',[ 'as' => 'searchSightSeen', 'uses' =>  'CityExplorer@searchSight']);
