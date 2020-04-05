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

Route::group(['middleware' => ['mobile_detect']], function () {

    /* home route */
    Route::get('/', 'Mobile\HomeController@index')->name('home');
    
    /* intro route */
    Route::get('/intro', 'Mobile\HomeController@intro')->name('home.intro');

    /* user route */
    Route::get('/user/{id}', 'Mobile\ProfileController@show')->name('user.show');

	/* search package */
	Route::get('search', 'Mobile\HomeController@search')->name('search');
    Route::post('searching', 'Mobile\HomeController@searching')->name('searching');
    /* autocomplete search */
    Route::get('/search/autocomplete', 'Mobile\HomeController@airport_autocomplete')->name('home.search.autocomplete');

	Auth::routes();

	/* google login*/
    Route::get('auth/google', 'Auth\LoginController@redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback')->name('auth.google.callback');
});

Route::group(['middleware' => ['mobile_detect', 'auth']], function () {
    /* Trips */

    Route::group(['prefix' => 'trip',  'middleware' => 'check_profile'], function()
    {
        Route::get('my', 'Mobile\TripController@index')->name('trip.index');
        Route::get('create', 'Mobile\TripController@create')->name('trip.create');
        Route::get('create_pickup/{packageId}', 'Mobile\TripController@create')->name('trip.create_pickup');
        Route::post('store', 'Mobile\TripController@store')->name('trip.store');
        Route::get('show/{id}', 'Mobile\TripController@show')->name('trip.show');
        Route::post('disable', 'Mobile\TripController@disable')->name('trip.disable');

        /* request trip */
        Route::get('request/{id}', 'Mobile\TripController@request')->name('trip.request');
        Route::post('request/save', 'Mobile\TripController@requestSave')->name('trip.request.save');
        Route::get('request/detail/{id}', 'Mobile\TripController@requestdetail')->name('trip.request.detail');
        
        /* create invoices */
        Route::post('request/create_invoice/{id}', 'Mobile\TripController@create_invoice')->name('trip.create.invoice');
    });
    
    Route::group(['prefix' => 'package',  'middleware' => 'check_profile'], function()
    {
        /* package route */
        Route::get('/', 'Mobile\PackageController@index')->name('package');
        Route::get('/create', 'Mobile\PackageController@create')->name('package.create');
        Route::get('create_send/{packageId}', 'Mobile\PackageController@create')->name('package.create_send');
        Route::post('/store', 'Mobile\PackageController@store')->name('package.store');
        Route::get('/show/{id}', 'Mobile\PackageController@show')->name('package.show');

        /* request package */
        Route::get('request/{id}', 'Mobile\PackageController@request')->name('package.request');
        Route::post('request/save', 'Mobile\PackageController@requestSave')->name('package.request.save');
        Route::get('request/detail/{id}', 'Mobile\PackageController@requestdetail')->name('package.request.detail');
        Route::get('request/accept/{packageId}/{tripId}', 'Mobile\PackageController@requestaccept')->name('package.request.accept');

        /* create invoices */
        Route::post('request/create_invoice/{id}', 'Mobile\PackageController@create_invoice')->name('package.create.invoice');
    });

    /* notifications route */
	Route::get('/notifications', 'Mobile\NotificationsController@index')->name('notifications');

	/* profile route */
	Route::get('/profile/edit', 'Mobile\ProfileController@index')->name('profile.edit');
    Route::get('/profile/changepassword', 'Mobile\ProfileController@changepassword')->name('profile.changepassword');
    Route::get('/profile/privacy', 'Mobile\ProfileController@privacy')->name('update.privacy');
	Route::post('/profile/update/{id}', 'Mobile\ProfileController@update')->name('update.profile');
    Route::post('/profile/password', 'Mobile\ProfileController@password')->name('update.password');

    // status
    Route::get('/status', 'Mobile\StatusController@index')->name('status');
    Route::post('/status/update', 'Mobile\StatusController@update')->name('status.update');
    Route::post('/status/feedback', 'Mobile\StatusController@feedback')->name('status.feedback');

    /* mypixen route */
    Route::get('/mypixen', 'Mobile\MypixenController@index')->name('mypixen');
    Route::get('/mypixen/package/{id}', 'Mobile\MypixenController@PackageDetail')->name('mypixen.package.show');
    Route::get('/mypixen/trip/{id}', 'Mobile\MypixenController@TripDetail')->name('mypixen.trip.show');

    // payment
    Route::get('/payment', 'Mobile\PaymentController@index')->name('payment');
    Route::get('/payment/detail/{id}', 'Mobile\PaymentController@detail')->name('payment.detail');
    Route::get('/payment/success/{id}', 'Mobile\PaymentController@success')->name('payment.success');
    /* paypal checkout */
    Route::get('/paypal/checkout/{id}', 'Mobile\PaypalController@getExpressCheckout')->name('paypal.checkout');
    Route::get('/paypal/checkout-success/{id}', 'Mobile\PaypalController@getExpressCheckoutSuccess')->name('paypal.checkout-success');
    Route::get('/paypal/adaptive-pay', 'Mobile\PaypalController@getAdaptivePay')->name('paypal.adaptive');
    Route::post('/paypal/notify', 'Mobile\PaypalController@notify')->name('paypal.notify');

    // setting
    Route::get('/setting', 'Mobile\HomeController@setting')->name('setting');

    /* upload image profile*/
    Route::post('/upload-image-profile', 'Mobile\ImageController@UploadImageProfile')->name('upload.image.profile');


    Route::post('/crop-image', 'Mobile\ImageController@CropImage')->name('crop.image');

    /* input fill use autocomplete */
    Route::get('/country-autocomplete', 'Mobile\HomeController@country_autocomplete')->name('country.autocomplete');

    /* input fill use autocomplete */
    Route::post('/rating', 'Mobile\HomeController@rating')->name('rating');

    /* comments */
    Route::post('/comments/add', 'Mobile\CommentsController@add')->name('comments.add');
    Route::get('/comments/delete', 'Mobile\CommentsController@delete')->name('comments.delete');
    Route::post('/comments/update', 'Mobile\CommentsController@update')->name('comments.update');

    /* decline request */
    Route::get('request/decline/{id}/{redirect}/{to}', 'Mobile\HomeController@decline')->name('request.decline');

});


