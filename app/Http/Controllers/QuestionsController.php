<?php

namespace App\Http\Controllers;

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
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'approve']);
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
        return back()->withNotification('Success! Your question is awaiting approval by a Moderator.');

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

    public function approve($id)
    {
        $question = $this->question->findOrFail($id);
        $question->approved = 1;
        $question->save();

    }

    /**
     * Returns all Questions to User
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
        $questions = Auth::user()->notAnsweredQuestions()->approved()->latest()->paginate(10);
        return view('questions.user')->withQuestions($questions);
    }

    public function answer($slug)
    {
        $alumini = Alumini::whereSlug($slug)->firstorFail();

    }
}
