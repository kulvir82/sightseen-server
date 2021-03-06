<?php
use Illuminate\Http\Request;
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


//admin routes
Route::group(['middleware' => 'auth'], function () {
  Route::post('/userprofile','CityExplorer@getUserProfile');
  Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
  Route::get('/getsightseen','CityExplorer@sight_seen');
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
  Route::get('/bookings','UserBookingController@index');
  Route::get('/getbookingdetail/{id}','UserBookingController@getBookingDetail');
  Route::post('/addTax','CityExplorer@addTax');
  Route::get('/getTax/{country_id}','CityExplorer@getTax');
  Route::post('/addvoucher', 'UserBookingController@addVoucher');
  Route::post('/updatebooking', 'UserBookingController@updateBooking');
  Route::post('/removevoucher', 'UserBookingController@removeVoucher');
  Route::post('/sendvoucheremail', 'UserBookingController@sendVoucherEmail');
  Route::get('/usersdetail', 'UsersController@getUsersDetail');
  Route::post('/searchuserdetail', 'UsersController@searchUsersDetail');

});

Route::get('/getcountries','CityExplorer@getCountry');
Route::post('/getcities','CityExplorer@getCity');
Route::get('/userTimeline','TwitterController@getTweets');
Route::post('/usersendmail','ContactUs@saveEmailData');
//user routes
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/getsightseenfromcountry','CityExplorer@getSightSeenFromCountry');
Route::post('getsightseenfromcity','CityExplorer@getSightSeenFromCity');
Route::post('/verifypincode','UsersController@verifyPin');
Route::get('/addtocart','UsersController@addProductToUsersCart');
Route::post('/productsdata','CityExplorer@getProductDetail');
Route::get('/getPopularSightSeen', 'SightSeensController@getPopularSightSeen');


  Route::get('/{any}', function(){
      return view('frontview.index');
    })->where('any', '.*');

Route::get('/sendmail', function (Request $request) {
  $data = [
                'username' => 'Abhi',
                'sightseen' => 'Chaophraya dinner Cruise on sic has been',
                'persons' => 5,
                'date' => '2018-02-15',
                'booking_number' => 'jhgf763we3',
                'attachment' => $request->file_url
            ];
  Mail::send('emails.voucher', $data, function ($message) {
    $message
      ->to('abhishek.sharma@apptreetechnologies.com', 'Receiver Name')
      ->bcc('sharmaabhi805@gmail.com')
      ->subject('Voucher Email Confirmation for Chaophraya dinner Cruise on sic has been');
  });
});
