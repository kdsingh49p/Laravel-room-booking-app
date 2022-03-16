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

Route::post('/site/transaction-success', 'SiteController@transactionSuccess');
Route::post('/site/transaction-fail', 'SiteController@transactionFail');

Route::post('user/login', 'SiteController@checkLogin');

Route::group(['prefix' => '/dashboard', 'middleware' => 'auth:web,admin'], function()
{
    Route::get('/index', 'SiteController@dashboard');
    Route::get('/events', 'SiteController@purchasedevents');

    
});
Route::get('site/contactpost', 'SiteController@contactpost');
Route::get('/signin', function () {
    return view('login');
});
Route::get('/cart', function () {
    return view('cart');
});
 
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/deal-grid-view', function () {
    return view('deal-grid-view');
});
Route::get('/deal-view', function () {
    return view('deal-view');
});
Route::get('/about-us', function () {
    return view('about-us');
});
Route::get('/signup', function () {
    return view('signup');
});
Route::get('/checkout', 'SiteController@checkout');

 Route::get('/events', 'EventController@listevent');

Route::get('/event/{slug}', 'EventController@event_view');


Route::get('/', [ 
                        'as' => 'login',
                        'uses' => 'SiteController@login'
                    ]
        );

Route::get('/logout', 'UserRegisterController@logout');
Route::get('site/logout', 'SiteController@logout');

 

Route::group(['prefix' => '', 'middleware' => 'auth:admin'], function()
{


Route::get('/welcome', 'SiteController@welcome');

  //Mode of Payment
    Route::get('/mode-of-payment/create', 'ModeOfPaymentController@create');
    Route::get('/mode-of-payment/index', 'ModeOfPaymentController@index');
    Route::post('/mode-of-payment/store', 'ModeOfPaymentController@store');
    Route::get('/mode-of-payment/update/{Id}', 'ModeOfPaymentController@update');
    Route::get('/mode-of-payment/fetchdata', 'ModeOfPaymentController@fetchdata');
    Route::put('/mode-of-payment/edit/{Id}', 'ModeOfPaymentController@edit');
    Route::get('/mode-of-payment/show/{Id}', 'ModeOfPaymentController@show');
    Route::delete('/mode-of-payment/delete/{Id}', 'ModeOfPaymentController@destroy');
    Route::get('/mode-of-payment/checkvalidation', 'ModeOfPaymentController@checkvalidation');

  //Disease Master

    Route::get('/patient', 'PatientController@index');
    Route::get('/patient/index', 'PatientController@index');
    Route::get('/patient/search', 'PatientController@search');
    Route::get('/patient/create', 'PatientController@create');
    Route::post('/patient/store', 'PatientController@store');
    Route::get('/patient/update/{id}', 'PatientController@update');
    Route::post('/patient/edit/{id}', 'PatientController@edit');
    Route::get('/patient/active-inactive/{id}', 'PatientController@activeinactive');
    Route::get('/patient/show/{id}', 'PatientController@show');
    Route::get('/patient/delete/{id}', 'PatientController@destroy');
    Route::get('/patient/checkvalidation', 'PatientController@checkvalidation');
    Route::get('/patient/sendsms', 'PatientController@sendsms');
    Route::post('/patient/sendsms', 'PatientController@sendsms_logic');

    Route::get('/booking', 'BookingController@index');
    Route::get('/booking/index', 'BookingController@index');
    Route::get('/booking/search', 'BookingController@search');
    Route::get('/booking/create', 'BookingController@create');
    Route::post('/booking/store', 'BookingController@store');
    Route::get('/booking/update/{id}', 'BookingController@update');
    Route::post('/booking/edit/{id}', 'BookingController@edit');
    Route::get('/booking/active-inactive/{id}', 'BookingController@activeinactive');
    Route::get('/booking/show/{id}', 'BookingController@show');
    Route::get('/booking/delete/{id}', 'BookingController@destroy');
    Route::get('/booking/checkvalidation', 'BookingController@checkvalidation');
    Route::get('/booking/delete_room/', 'BookingController@delete_room');
     Route::get('/booking/print/{id}', 'BookingController@print_invoice');
     Route::get('/booking/getDetails/', 'BookingController@getDetails');

    Route::get('/booking/reports', 'BookingController@booking_report');
    Route::get('/booking/booking_report_search', 'BookingController@booking_report_search');
    Route::get('/booking/booking_report_export', 'BookingController@booking_report_export');



        Route::get('/booking/room_report', 'BookingController@room_report');
    Route::get('/booking/room_report_search', 'BookingController@room_report_search');
    Route::get('/booking/room_report_export', 'BookingController@room_report_export');

    Route::get('/room', 'RoomController@index');
    Route::get('/room/index', 'RoomController@index');
    Route::get('/room/search', 'RoomController@search');
    Route::get('/room/create', 'RoomController@create');
    Route::post('/room/store', 'RoomController@store');
    Route::get('/room/update/{id}', 'RoomController@update');
    Route::post('/room/edit/{id}', 'RoomController@edit');
    Route::get('/room/active-inactive/{id}', 'RoomController@activeinactive');
    Route::get('/room/show/{id}', 'RoomController@show');
    Route::get('/room/delete/{id}', 'RoomController@destroy');
    Route::get('/room/checkvalidation', 'RoomController@checkvalidation');
    Route::get('/room/getavailabelrooms', 'RoomController@getavailabelrooms');


    Route::get('/company', 'CompanyController@index');
    Route::get('/company/index', 'CompanyController@index');
    Route::get('/company/search', 'CompanyController@search');
    Route::get('/company/create', 'CompanyController@create');
    Route::post('/company/store', 'CompanyController@store');
    Route::get('/company/update/{id}', 'CompanyController@update');
    Route::post('/company/edit/{id}', 'CompanyController@edit');
    Route::get('/company/active-inactive/{id}', 'CompanyController@activeinactive');
    Route::get('/company/show/{id}', 'CompanyController@show');
    Route::get('/company/delete/{id}', 'CompanyController@destroy');
    Route::get('/company/checkvalidation', 'CompanyController@checkvalidation');
    Route::get('/company/getavailabelrooms', 'CompanyController@getavailabelrooms');



     Route::get('/addon', 'AddonController@index');
    Route::get('/addon/index', 'AddonController@index');
    Route::get('/addon/search', 'AddonController@search');
    Route::get('/addon/create', 'AddonController@create');
    Route::post('/addon/store', 'AddonController@store');
    Route::get('/addon/update/{id}', 'AddonController@update');
    Route::post('/addon/edit/{id}', 'AddonController@edit');
    Route::get('/addon/active-inactive/{id}', 'AddonController@activeinactive');
    Route::get('/addon/show/{id}', 'AddonController@show');
    Route::get('/addon/delete/{id}', 'AddonController@destroy');
    Route::get('/addon/checkvalidation', 'AddonController@checkvalidation');

    Route::get('/user-register', 'UserRegisterController@index');
    Route::get('/user-register/index', 'UserRegisterController@index');
    Route::get('/user-register/search', 'UserRegisterController@search');
    Route::get('/user-register/create', 'UserRegisterController@create');
    Route::post('/user-register/store', 'UserRegisterController@store');
    Route::get('/user-register/update/{id}', 'UserRegisterController@update');
    Route::post('/user-register/edit/{id}', 'UserRegisterController@edit');
    Route::get('/user-register/active-inactive/{id}', 'UserRegisterController@activeinactive');
    Route::get('/user-register/show/{id}', 'UserRegisterController@show');
    Route::get('/user-register/delete/{id}', 'UserRegisterController@destroy');
    Route::get('/user-register/checkvalidation', 'UserRegisterController@checkvalidation');
    Route::get('/user-register/getavailabelrooms', 'UserRegisterController@getavailabelrooms');


  
});




Route::get('/merchant', 'admin\MerchantController@login');
Route::post('/merchant/checklogin', 'admin\MerchantController@checkLogin');
Route::post('/user-register/checklogin', 'UserRegisterController@checklogin');
    Route::get('/user-register/login', 'UserRegisterController@login');


//Deals
Route::get('/deals/create', 'DealsController@create');
Route::post('/deals/store', 'DealsController@store');
Route::get('/deals/update/{DealId}', 'DealsController@update');
Route::put('/deals/edit/{DealId}', 'DealsController@edit');
Route::delete('/deals/delete/{DealId}', 'DealsController@destroy');
Route::delete('/deals/delete_option/{DealId}', 'DealsController@delete_option');

 





Route::post('/user/register', 'UserController@register');
Route::post('/user/verify_otp', 'UserController@verify_otp');
Route::post('/user/checklogin', 'UserController@checklogin');




Route::get('/deal/{slug}', 'DealsController@dealview');
Route::get('/deal/invoice/{purchase_id}', 'SiteController@invoice');
Route::get('/event/invoice/{purchase_id}', 'SiteController@eventinvoice');

Route::get('/category/{slug}', 'DealsController@gridview');
Route::get('/deals/search', 'DealsController@search');


Route::get('/deals/addcart', 'DealsController@addcart');
Route::get('site/eventcart/{eventId}', 'SiteController@eventcart');
Route::get('/deals/deleterow', 'DealsController@deleterow');
Route::post('/site/checkoutevent', 'SiteController@checkoutevent');
Route::post('/eventcheckoutsave', 'SiteController@eventcheckoutsave');