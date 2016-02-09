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

    // FOR TESTING THINGS

    Route::get('/test', function(){
        $q = App\Question::find(6);
        dd(Gate::allows('answer',Auth::user(), $q ));
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/dashboard', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/@{username}', ['as' => 'users.profile.show', 'uses' => 'UsersController@showProfile']);
    Route::get('/@{username}/edit',['as' => 'users.profile.edit', 'uses' => 'UsersController@editProfile']);
    Route::post('/@{username}/edit',['as' => 'users.profile.update', 'uses' => 'UsersController@updateProfile']);

    Route::get('/alumini', ['as' => 'alumini.index', 'uses' => 'AluminisController@index']);
    Route::get('/alumini/create', ['as' => 'alumini.create', 'uses' => 'AluminisController@create']);
    Route::post('/alumini/create', ['as' => 'alumini.store', 'uses' => 'AluminisController@store']);
    Route::get('/alumini/{slug}', ['as' => 'alumini.show', 'uses' => 'AluminisController@show']);

    Route::get('/events', ['as' => 'event.index', 'uses' => 'EventsController@index']);
    Route::get('/events/create', ['as' => 'event.create', 'uses' => 'EventsController@create']);
    Route::post('/events/create', ['as' => 'event.store', 'uses' => 'EventsController@store']);
    Route::get('/events/{slug}', ['as' => 'event.show', 'uses' => 'EventsController@show']);

    Route::get('/news', ['as' => 'news.index', 'uses' => 'NewsController@index']);
    Route::get('/news/create', ['as' => 'news.create', 'uses' => 'NewsController@create']);
    Route::post('/news/create', ['as' => 'news.store', 'uses' => 'NewsController@store']);
    Route::get('/news/{slug}', ['as' => 'news.show', 'uses' => 'NewsController@show']);

    Route::get('/questions', ['as' => 'questions.index', 'uses' => 'QuestionsController@index']);
    Route::get('/questions/create', ['as' => 'questions.create', 'uses' => 'QuestionsController@create']);
    Route::post('/questions/create', ['as' => 'questions.store', 'uses' => 'QuestionsController@store']);
    Route::get('/questions/{slug}', ['as' => 'questions.show', 'uses' => 'QuestionsController@show']);

    Route::get('/my/questions/', ['as' => 'questions.user', 'uses' => 'QuestionsController@forUser']);
    Route::get('/my/questions/unanswered', ['as' => 'questions.user.unanswered', 'uses' => 'QuestionsController@forUserToAnswer']);
});