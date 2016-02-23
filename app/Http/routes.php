<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');

    Route::get('/', function () {
        return view('pages.home');
    });

    Route::resource('flyers', 'FlyersController');
});
