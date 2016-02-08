<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', function () {
        return view('welcome');
    });
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/home', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/@{username}', ['as' => 'users.profile.show', 'uses' => 'UsersController@showProfile']);
    Route::get('/@{username}/edit',['as' => 'users.profile.edit', 'uses' => 'UsersController@editProfile']);
    Route::post('/@{username}/edit',['as' => 'users.profile.update', 'uses' => 'UsersController@updateProfile']);


    Route::get('/alumini', ['as' => 'alumini.index', 'uses' => 'AluminisController@index']);
    Route::get('/alumini/create', ['as' => 'alumini.create', 'uses' => 'AluminisController@create']);
    Route::post('/alumini/create', ['as' => 'alumini.store', 'uses' => 'AluminisController@store']);

    Route::get('/events', ['as' => 'event.index', 'uses' => 'EventsController@index']);
    Route::get('/events/create', ['as' => 'event.create', 'uses' => 'EventsController@create']);
    Route::post('/events/create', ['as' => 'event.store', 'uses' => 'EventsController@store']);
});
