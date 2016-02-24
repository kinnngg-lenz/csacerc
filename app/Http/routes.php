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
        $news = App\News::whereType(0)->latest()->first();
        $event = App\Event::latest()->first();
        $codewars = App\CodeWarQuestion::latest()->limit(3)->get();
        $questions = App\Question::wherePublic(1)->approved()->latest()->limit(3)->get();
        $aluminis = App\Alumini::latest()->limit(2)->get();
        $users = App\User::latest()->limit(3)->get();
        $picture = App\Photo::whereGallery(1)->get()->random();
        $technews = App\News::whereType(1)->latest()->first();

        $data = [
            'news' => $news,
            'event' => $event,
            'aluminis' => $aluminis,
            'codewars' => $codewars,
            'questions' => $questions,
            'users' => $users,
            'picture' => $picture,
            'technews' => $technews,
        ];
        return view('welcome',$data);
    });

    /**
     * Coming Soon Page
     */
    Route::get('/comingsoon', function(){
        return view('comingsoon');
    });

    // FOR TESTING ONLY NOT FOR PRODUCTION
    Route::get('/images/{url}/thumbnail/{width?}', function(){

        $image = Image::make(public_path().'/images/static/birds.jpg');

        $image->resize(600, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        $new = new Intervention\Image\Response($image);
        return $new->make();
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
    Route::get('image/{url}/thumbnail/{width?}', ['as' => 'make.thumbnail', 'uses' => 'PhotosController@thumbnail']);

    /**
     * Likes Controller
     */
    Route::post('/codewar/{war_id}/answers/{answer_id}/likes', ['as' => 'codewar.likes.post', 'uses' => 'LikesController@likeCWA']);
    Route::post('/codewar/{war_id}/likes', ['as' => 'codewar.question.likes.post', 'uses' => 'LikesController@likeCWQ']);
    Route::post('/questions/{question_id}/likes', ['as' => 'questions.question.likes.post', 'uses' => 'LikesController@likeQQ']);

    /**
     * NewsLetter Controller
     */
    Route::post('/newsletter/subscribe', ['as' => 'newsletter.subscribe', 'uses' => 'NewsletterController@subscribe']);
});

/**
 * For API Calls and Ajax Search
 *
 * Outside of Web Guard so that escaped by CRSF middleware
 */
Route::get('/users/{query}', ['as' => 'users.search', 'uses' => 'UsersController@search']);
Route::get('/inspire', ['as' => 'inspire', 'uses' => 'ApisController@inspire']);

