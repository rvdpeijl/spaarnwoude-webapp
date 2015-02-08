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

Route::get('massadd', function() {
    // $activities = Activity::all();

    // foreach ($activities as $key => $activity) {
    //     File::makeDirectory(public_path().'/plaatjedingems/'.$activity->id.'/logo');
    //     File::makeDirectory(public_path().'/plaatjedingems/'.$activity->id.'/medium');
    // }
    // return 'done';
});

// API
Route::group(array('prefix' => 'api'), function()
{
    Route::resource('activities', 'ActivitiesController');
    Route::resource('agenda', 'AgendaController');
    Route::resource('news', 'NewsController');
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

    Route::get('agenda', function()
    {
        return View::make('admin.agenda.index');
    });

    Route::get('news', function()
    {
        return View::make('admin.news.index');
    });

});

App::missing(function($exception)
{
	return View::make('index');
});