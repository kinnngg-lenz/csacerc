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
    Route::get('/', ['as' => 'welcome', function () {
        $news = App\News::whereType(0)->latest()->first();
        $event = App\Event::latest()->first();
        $codewars = App\CodeWarQuestion::latest()->limit(3)->get();
        $questions = App\Question::wherePublic(1)->approved()->latest()->limit(3)->get();
        $aluminis = App\Alumini::where('speech','!=','null')->get()->random(2);
        $users = App\User::latest()->limit(3)->get();
        $picture = App\Photo::whereGallery(1)->get()->random();
        $technews = App\News::whereType(1)->latest()->first();
        $qotd = App\Quote::getQotd();
        $shouts = App\Shout::limit(15)->latest()->get();

        $shouts = $shouts->sortBy('created_at');

        $urls = ['http://numbersapi.com/random/','http://numbersapi.com/random/year/','http://numbersapi.com/random/date'];
        try
        {
            $didyouknow = file_get_contents($urls[array_rand($urls)]);
        }
        catch(Exception $e)
        {
            $didyouknow = "This website is hosted on a VPS with 1GB of RAM and is developed using PHP as backend, MySQL & Redis for database storage, and Sockets for real time events.";
        }

        $data = [
            'news' => $news,
            'event' => $event,
            'aluminis' => $aluminis,
            'codewars' => $codewars,
            'questions' => $questions,
            'users' => $users,
            'picture' => $picture,
            'technews' => $technews,
            'qotd' => $qotd,
            'shouts' => $shouts,
            'didyouknow' => $didyouknow
        ];
        return view('welcome',$data);
    }]);

    /**
     * Coming Soon Page
     */
    Route::get('/comingsoon', function(){
        return view('comingsoon');
    });

    /**
     * About Us Page
     */
    Route::get('/aboutus', function(){
        return view('aboutus');
    });

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/dashboard', ['as' => 'home', 'uses' => 'HomeController@index']);

    /**
     * Users Controller
     */
    Route::get('/@{username}', ['as' => 'users.profile.show', 'uses' => 'UsersController@showProfile']);
    Route::get('/@{username}/edit',['as' => 'users.profile.edit', 'uses' => 'UsersController@editProfile']);
    Route::post('/@{username}/edit',['as' => 'users.profile.update', 'uses' => 'UsersController@updateProfile']);
    Route::patch('/toggleban/@{username}',['middleware' => 'admin:3', 'as' => 'users.toggleban', 'uses' => 'UsersController@toggleBanUser']);
    Route::get('/search/', ['as' => 'users.search', 'uses' => 'UsersController@searchForNav']);

    /**
     * Aluminis Controller
     */
    Route::get('/alumini', ['as' => 'alumini.index', 'uses' => 'AluminisController@index']);
    Route::get('/alumini/create', ['as' => 'alumini.create', 'uses' => 'AluminisController@create']);
    Route::post('/alumini/create', ['as' => 'alumini.store', 'uses' => 'AluminisController@store']);
    Route::get('/alumini/{slug}', ['as' => 'alumini.show', 'uses' => 'AluminisController@show']);
    Route::get('/alumini/{id}/edit', ['as' => 'alumini.edit', 'uses' => 'AluminisController@edit']);
    Route::patch('/alumini/{id}/edit', ['as' => 'alumini.update', 'uses' => 'AluminisController@update']);

    /**
     * Events Controller
     */
    Route::get('/events', ['as' => 'event.index', 'uses' => 'EventsController@index']);
    Route::get('/events/create', ['as' => 'event.create', 'uses' => 'EventsController@create']);
    Route::post('/events/create', ['as' => 'event.store', 'uses' => 'EventsController@store']);
    Route::get('/events/{slug}', ['as' => 'event.show', 'uses' => 'EventsController@show']);

    /**
     * News Controller
     */
    Route::get('/news', ['as' => 'news.index', 'uses' => 'NewsController@index']);
    Route::get('/news/create', ['as' => 'news.create', 'uses' => 'NewsController@create']);
    Route::post('/news/create', ['as' => 'news.store', 'uses' => 'NewsController@store']);
    Route::get('/news/{slug}', ['as' => 'news.show', 'uses' => 'NewsController@show']);

    /**
     * Questions Controller
     */
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
     * CODE WAR Controller
     */
    Route::get('/codewar', ['as' => 'codewar.index', 'uses' => 'CodeWarsController@index']);
    Route::get('/codewar/create', ['as' => 'codewar.create', 'uses' => 'CodeWarsController@create']);
    Route::post('/codewar/create', ['as' => 'codewar.store', 'uses' => 'CodeWarsController@store']);
    Route::get('/codewar/{id}/edit', ['as' => 'codewar.edit', 'uses' => 'CodeWarsController@edit']);
    Route::patch('/codewar/{id}/edit', ['as' => 'codewar.update', 'uses' => 'CodeWarsController@update']);
    Route::patch('/codewar/{id}/bestanswer', ['as' => 'codewar.bestanswer', 'uses' => 'CodeWarsController@bestanswer']);
    Route::get('/codewar/{slug}', ['as' => 'codewar.show', 'uses' => 'CodeWarsController@show']);
    Route::post('/codewar/{slug}', ['as' => 'codewar.answer', 'uses' => 'CodeWarsController@answer']);

    /**
     * Gallery Controller
     */
    Route::get('/gallery', ['as' => 'gallery.index', 'uses' => 'PhotosController@index']);
    Route::get('/gallery/create', ['as' => 'gallery.create', 'uses' => 'PhotosController@create']);
    Route::post('/gallery/create', ['as' => 'gallery.store', 'uses' => 'PhotosController@store']);
    Route::get('/gallery/{url}', ['as' => 'gallery.show', 'uses' => 'PhotosController@show']);
    Route::get('/image/{url}/thumbnail/{width?}', ['as' => 'make.thumbnail', 'uses' => 'PhotosController@thumbnail']);

    /**
     * Likes Controller
     */
    Route::post('/codewar/{war_id}/answers/{answer_id}/likes', ['as' => 'codewar.likes.post', 'uses' => 'LikesController@likeCWA']);
    Route::post('/codewar/{war_id}/likes', ['as' => 'codewar.question.likes.post', 'uses' => 'LikesController@likeCWQ']);
    Route::post('/questions/{question_id}/likes', ['as' => 'questions.question.likes.post', 'uses' => 'LikesController@likeQQ']);

    /**
     * Notes Controller
     */
    Route::get('/notes/create', ['as' => 'notes.create', 'uses' => 'NotesController@create']);
    Route::post('/notes/create', ['as' => 'notes.create', 'uses' => 'NotesController@store']);
    Route::get('/notes', ['as' => 'notes.index', 'uses' => 'NotesController@index']);
    Route::get('/notes/{id}/download', ['as' => 'notes.download', 'uses' => 'NotesController@download']);
    Route::get('/notes/{slug}', ['as' => 'notes.show', 'uses' => 'NotesController@show']);

    /**
     * Quotes Controller
     */
    Route::get('/quotes/create', ['as' => 'quotes.create', 'uses' => 'QuotesController@create']);
    Route::post('/quotes/create', ['as' => 'quotes.create', 'uses' => 'QuotesController@store']);
    Route::get('/quotes', ['as' => 'quotes.index', 'uses' => 'QuotesController@index']);
    Route::get('/quotes/{id}/edit', ['as' => 'quotes.edit', 'uses' => 'QuotesController@edit']);
    Route::patch('/quotes/{id}/edit', ['as' => 'quotes.update', 'uses' => 'QuotesController@update']);
    Route::get('/quotes/{id}/setasqotd', ['as' => 'quotes.setasqotd','uses' => 'QuotesController@setasqotd']);

    /**
     * OrganisationsController
     */
    Route::get('/organisations', ['as' => 'org.index', 'uses' => 'OrganisationsController@index']);
    Route::get('/org/create', ['as' => 'org.create', 'uses' => 'OrganisationsController@create']);
    Route::post('/org/create', ['as' => 'org.create', 'uses' => 'OrganisationsController@store']);
    Route::delete('/org/{id}', ['as' => 'org.delete', 'uses' => 'OrganisationsController@destroy']);

    /**
     * NewsLetter Controller
     */
    Route::post('/newsletter/subscribe', ['as' => 'newsletter.subscribe', 'uses' => 'NewsletterController@subscribe']);
    Route::get('/newsletter', ['as' => 'newsletter.index', 'uses' => 'NewsletterController@index']);
    Route::get('/newsletter/{name}', ['as' => 'newsletter.show', 'uses' => 'NewsletterController@show']);
    Route::get('/newsletter/{name}/download', ['as' => 'newsletter.download', 'uses' => 'NewsletterController@download']);

    /**
     * Messages Controller
     */
    Route::get('/conversation/new', ['as' => 'messages.new', 'uses' => 'MessagesController@start']);
    Route::get('/messages/@{username}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::post('/messages/@{username}', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('/administrator/messages/@{username1}/@{username2}', ['middleware' => ['auth', 'admin:4'], 'as' => 'messages.showadmin', 'uses' => 'MessagesController@showadmin']);
    Route::delete('/messages/{id}', ['as' => 'messages.delete', 'uses' => 'MessagesController@destroy']);

    /**
     * Shouts Controller
     */
    Route::post('/shouts/do',['as' => 'shouts.store', 'uses' => 'ShoutsController@store']);
    Route::delete('/shouts/{id}/delete', ['as' => 'shouts.delete', 'uses' => 'ShoutsController@destroy']);

    /**
     * Apps Club Controller
     */
    Route::get('/appsclub', ['as' => 'appsclub.index', 'uses' => 'AppsclubController@index']);

});

/**
 * For API Calls and Ajax Search
 *
 * Outside of Web Guard so that escaped by CSRF middleware
 */
Route::get('/inspire', ['as' => 'inspire', 'uses' => 'ApisController@inspire']);
Route::get('/users/{query}', ['as' => 'users.search', 'uses' => 'UsersController@search']);
Route::get('/dyk', ['as' => 'dyk', 'uses' => 'ApisController@didyouknow']);

Route::get('/api/inspire', ['as' => 'api.inspire', 'uses' => 'ApisController@inspireAPI']);
Route::get('/api/users/{query}', ['as' => 'api.users.search', 'uses' => 'UsersController@search']);
Route::get('/api/didyouknow', ['as' => 'api.dyk', 'uses' => 'ApisController@didyouknowAPI']);