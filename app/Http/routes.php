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

    /**
     * Landing Page
     */
    Route::get('/', function () {
        return view('welcome');
    });

    /**
     * Coming Soon Page
     */
    Route::get('/comingsoon', function(){
        return view('comingsoon');
    });

    // FOR TESTING ONLY NOT FOR PRODUCTION
    Route::get('/test', function(){
        $d = Newsletter::subscribe('afaquezishanansari@gmail.com');
        dd($d);
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
    Route::patch('/questions/{slug}', ['as' => 'questions.answer', 'uses' => 'QuestionsController@answer']);

    Route::post('pending/questions/{question}/approve', ['as' => 'questions.pending.approve', 'uses' => 'QuestionsController@approve']);
    Route::get('pending/questions/', ['as' => 'questions.pending', 'uses' => 'QuestionsController@pending']);
    Route::get('/questions-asked-to-me/', ['as' => 'questions.user', 'uses' => 'QuestionsController@forUser']);
    Route::get('/questions-i-asked/', ['as' => 'questions.iasked', 'uses' => 'QuestionsController@iAsked']);
    Route::get('/questions-asked-to-me/unanswered', ['as' => 'questions.user.unanswered', 'uses' => 'QuestionsController@forUserToAnswer']);

    /**
     * CODE WAR
     */
    Route::get('/codewar', ['as' => 'codewar.index', 'uses' => 'CodeWarsController@index']);
    Route::get('/codewar/create', ['as' => 'codewar.create', 'uses' => 'CodeWarsController@create']);
    Route::post('/codewar/create', ['as' => 'codewar.store', 'uses' => 'CodeWarsController@store']);
    Route::get('/codewar/{id}/edit', ['as' => 'codewar.edit', 'uses' => 'CodeWarsController@edit']);
    Route::patch('/codewar/{id}/edit', ['as' => 'codewar.update', 'uses' => 'CodeWarsController@update']);
    Route::patch('/codewar/{id}/bestanswer', ['as' => 'codewar.bestanswer', 'uses' => 'CodeWarsController@bestanswer']);
    Route::get('/codewar/{slug}', ['as' => 'codewar.show', 'uses' => 'CodeWarsController@show']);
    Route::post('/codewar/{slug}', ['as' => 'codewar.answer', 'uses' => 'CodeWarsController@answer']);

    Route::get('/gallery', ['as' => 'gallery.index', 'uses' => 'PhotosController@index']);
    Route::get('/gallery/create', ['as' => 'gallery.create', 'uses' => 'PhotosController@create']);
    Route::post('/gallery/create', ['as' => 'gallery.store', 'uses' => 'PhotosController@store']);
    Route::get('/gallery/{url}', ['as' => 'gallery.show', 'uses' => 'PhotosController@show']);

    /**
     * Likes Controller
     */
    Route::post('/codewar/{war_id}/answers/{answer_id}/likes', ['as' => 'codewar.likes.post', 'uses' => 'LikesController@likeCWA']);
    Route::post('/codewar/{war_id}/likes', ['as' => 'codewar.question.likes.post', 'uses' => 'LikesController@likeCWQ']);
    Route::post('/questions/{question_id}/likes', ['as' => 'questions.question.likes.post', 'uses' => 'LikesController@likeQQ']);
});

/**
 * For API Calls and Ajax Search
 *
 * Outside of Web Guard so that escaped by CRSF middleware
 */
Route::get('/users/{query}', ['as' => 'users.search', 'uses' => 'UsersController@search']);