<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('index');
});

// Authentication
Route::get('login', 'AuthController@getLogin');
Route::post('login', 'AuthController@postLogin');
Route::get('logout', 'AuthController@logout');

// API
Route::group(array('prefix' => 'api'), function()
{
    Route::resource('activities', 'ActivitiesController');
});

Route::group(array('prefix' => 'admin', 'before' => 'auth'), function()
{
    Route::get('/', function()
    {
        return View::make('admin.index');
    });

    Route::get('activities', function()
    {
        return View::make('admin.activities.index');
    });

});

App::missing(function($exception)
{
	return View::make('index');
});