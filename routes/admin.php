<?php

Route::group(['prefix'  =>  'admin'], function () {
    Route::get('', 'Admin\LoginController@showLoginForm')->name('admin.home.login');
    // Authentication Routes...
    Route::get('login', 'Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout', 'Admin\LoginController@logout')->name('admin.logout');

    Route::middleware('auth:admin')->group( function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard.index');
        })->name('admin.dashboard');

        // user
        Route::get('user', 'Admin\UserController@index')->name('admin.user');
        Route::post('user', 'Admin\UserController@index')->name('admin.user');
        Route::get('user/detail/{id}', 'Admin\UserController@detail')->name('admin.user.detail');
        Route::post('user/changepassword', 'Admin\UserController@changepassword')->name('admin.user.changepassword');

        // trips
        Route::get('trip', 'Admin\TripController@index')->name('admin.trip');
        Route::get('trip/detail/{id}', 'Admin\TripController@detail');

        // packages
        Route::get('package', 'Admin\PackageController@index')->name('admin.package');
        Route::get('package/detail/{id}', 'Admin\PackageController@detail');
    });
});
