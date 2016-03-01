<?php

Route::group(['middleware' => 'web'], function ()
{
	Route::auth();

	Route::get('/', 'PagesController@home');

	Route::post('flyers/post', 'FlyersController@store');
	Route::resource('flyers', 'FlyersController');
	Route::get('{zip}/{street}', 'FlyersController@show');
	// named route
	Route::post('{zip}/{street}/photos', [
		'as'   => 'store_photo_path',
		'uses' => 'PhotosController@store'
	]);

	Route::delete('photos/{id}', 'PhotosController@destroy');
});

