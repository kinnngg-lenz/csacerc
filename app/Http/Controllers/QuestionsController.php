<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerRequest;
use App\Http\Requests\QuestionsRequest;
use App\User;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Question;

class QuestionsController extends Controller
{
    /**
     * @var Question
     */
    protected $question;

    /**
     * @param Question $question
     */
    public function __construct(Question $question)
    {
        $this->middleware('auth',['except' => ['show', 'index']]);
        $this->middleware('admin', ['only' => ['approve', 'pending']]);
        $this->question = $question;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->question->public()->approved()->latest()->paginate();
        return view('questions.index')->withQuestions($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param QuestionsRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $askingTo = null;

        // Find the User whom this Quesion will be asked to if any
        if($request->has('asking_to')) {
            $askingTo = $request->asking_to;

            // Strip @ if any from beginning of string.
            $askingTo = trim($askingTo);
            $askingTo = ltrim($askingTo, '@');

            $askingTo = User::whereUsername($askingTo)->orWhere('email', $askingTo)->firstOrFail();
            $askingTo = $askingTo->id;
        }

        $slug = slug_for_url($request->question);

        $request->user()->questions()->create([
            'question' => $request->question,
            'public' => $request->public,
            'for_user_id' => $askingTo,
            'slug' => $slug,
        ]);

        $request->user()->xp = $request->user()->xp + 10;
        $request->user()->save();

        return back()->withNotification('Success! Your question is awaiting approval by a Moderator.')->withType('success');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $question = $this->question->whereSlug($slug)->firstorFail();
        return view('questions.show')->withQuestion($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approve(Question $question)
    {
        $question->approved = 1;
        $question->save();

        return back()->withNotification("Success! Question has been approved.")->withType('success');
    }

    public function pending()
    {
        $questions = $this->question->pending()->latest()->paginate();
        return view('questions.pending')->withQuestions($questions);
    }

    /**
     * Returns all Questions asked to this User
     * Both that User answered and not
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function forUser()
    {
        $questions = Auth::user()->askedQuestions()->approved()->latest()->paginate(10);
        return view('questions.user')->withQuestions($questions);
    }

    /**
     * Return only not answered questions to him
     *
     * @return mixed
     */
    public function forUserToAnswer()
    {
        /**
         * If Admin then return Questions asked globally too else return only those
         * questions asked to him.
         */
        if(Auth::user()->isAdmin())
            $questions = Auth::user()->notAnsweredQuestions(true)->approved()->latest()->paginate(10);
        else
            $questions = Auth::user()->notAnsweredQuestions(false)->approved()->latest()->paginate(10);

        return view('questions.user')->withQuestions($questions);
    }

    /**
     * @param $slug
     */
    public function answer(AnswerRequest $request, $slug)
    {
        $question = $this->question->findOrFail($request->question_id);

        $question->answer = $request->answer;
        $question->save();

        $request->user()->xp = $request->user()->xp + 20;
        $request->user()->save();

        return back()->withNotification("Success! Question has been answered.")->withType('success');
    }

    public function iAsked()
    {
        $questions = Auth::user()->questions()->latest()->paginate(10);

        return view('questions.iasked')->withQuestions($questions);
    }
}
