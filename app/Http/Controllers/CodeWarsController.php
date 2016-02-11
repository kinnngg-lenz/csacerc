<?php

namespace App\Http\Controllers;

use App\CodeWarAnswer;
use App\CodeWarQuestion;
use App\Http\Requests\CodeWarAnswersRequest;
use App\Http\Requests\CodeWarQuestionsRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CodeWarsController extends Controller
{
    /**
     * @var CodeWarQuestion
     */
    protected $question;

    /**
     * @var CodeWarAnswer
     */
    protected $answer;

    public function __construct(CodeWarQuestion $question, CodeWarAnswer $answer)
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['create', 'store', 'edit', 'update']]);
        $this->question = $question;
        $this->answer = $answer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = $this->question->latest()->paginate(10);
        return view('codewars.index')->withQuestions($questions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codewars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CodeWarQuestionsRequest|Request $request
     */
    public function store(CodeWarQuestionsRequest $request)
    {
        $slug = slug_for_url($request->title);
        $title = $request->title;
        $description = empty($request->description) ? null : $request->description;
        $ends_at = empty($request->ends_at) ? null : $request->ends_at;

        $request->user()->codeWarQuestions()->create([
            'title' => $title,
            'description' => $description,
            'slug' => $slug,
            'ends_at' => $ends_at,
        ]);

        return back()->withNotification('Success! War has been started.');
    }

    /**
     * Display the specified resource.
     *
     * @param $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $question = $this->question->whereSlug($slug)->with('answers')->firstOrFail();
        return view('codewars.show')->withQuestion($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $question = $this->question->findOrFail($id);

        if($request->user()->cannot('edit', $question))
        {
            return redirect("/")->withNotification("Sorry Buddy! You are not authorized.");
        }

        return view('codewars.edit')->withQuestion($question);
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
        $question = $this->question->findOrFail($id);

        if($request->user()->cannot('edit', $question))
        {
            return redirect('/')->withNotification("Sorry Buddy! You are not authorized.");
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => '',
        ]);

        $question->fill($request->only('title', 'description'))->save();

        return back()->withNotification("Success! Code War Updated.");

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

    public function answer(CodeWarAnswersRequest $request, $slug)
    {
        $question = $this->question->findOrFail($request->code_war_question_id);

        $question->answers()->create([
            'answer' => $request->answer,
            'user_id' => $request->user()->id,
        ]);

        return back()->withNotification("Success! Your answer now online :)");
    }
}
