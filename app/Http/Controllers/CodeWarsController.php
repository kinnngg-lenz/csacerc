<?php

namespace App\Http\Controllers;

use App\CodeWarAnswer;
use App\CodeWarQuestion;
use App\Http\Requests\CodeWarAnswersRequest;
use App\Http\Requests\CodeWarQuestionsRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use JavaScript;

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
        $ends_at = empty($request->ends_at) ? null : Carbon::parse($request->ends_at);

        $request->user()->codeWarQuestions()->create([
            'title' => $title,
            'description' => $description,
            'slug' => $slug,
            'ends_at' => $ends_at,
        ]);

        return back()->withNotification('Success! War has been started.')->withType('success');
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

        JavaScript::put([
            'count_down' => $question->ends_at
        ]);

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
            return redirect("/")->withNotification("Sorry Buddy! You are not authorized.")->withType('danger');;
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
            return redirect('/')->withNotification("Sorry Buddy! You are not authorized.")->withType('danger');
        }

        $this->validate($request, [
            'title' => 'required',
            'description' => '',
        ]);

        $description = empty($request->description) ? null : $request->description;
        $ends_at = empty($request->ends_at) ? null : Carbon::parse($request->ends_at);


        $question->title = $request->title;
        $question->description = $description;
        $question->ends_at = $ends_at;
        $question->save();

        return redirect()->route('codewar.show',$question->slug)->withNotification("Success! Code War Updated.");

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

    /**
     * Post answer to the current War with id
     *
     * @param CodeWarAnswersRequest $request
     * @param $slug
     * @return mixed
     */
    public function answer(CodeWarAnswersRequest $request, $slug)
    {
        $question = $this->question->findOrFail($request->code_war_question_id);

        $question->answers()->create([
            'answer' => $request->answer,
            'user_id' => $request->user()->id,
        ]);

        $request->user()->xp = $request->user()->xp + 20;
        $request->user()->save();

        return back()->withNotification("Success! Your answer now online.");
    }


    public function bestanswer(Request $request, $id)
    {
        $question = $this->question->findOrFail($id);

        $answer = $this->answer->findOrFail($request->best_answer_id);

        if($answer->code_war_question_id != $question->id)
        {
            return back()->withNotification("Error! Intrusion Detected and Blocked.");
        }

        if($request->user()->can('edit', $question))
        {
            $question->fill($request->only('best_answer_id'))->save();
            return back()->withNotification("Success! Answer set as Best. Will be visible once this War Ends.");
        }

        return back()->withNotification("Error! Something is not right)");
    }

    /**
     * Show Edit Answer Form
     *
     * @param CodeWarQuestion $codeWarQuestion
     * @param CodeWarAnswer $codeWarAnswer
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editAnswer(CodeWarQuestion $codeWarQuestion, CodeWarAnswer $codeWarAnswer, Request $request)
    {
        if($codeWarAnswer->question != $codeWarQuestion)
        {
            abort(404);
        }

        if($request->user()->can('edit',$codeWarAnswer))
        {
            return view('codewars.editanswer')->withAnswer($codeWarAnswer)->withQuestion($codeWarQuestion);
        }
        return back()->withNotification("Sorry Buddy! You are not authorized")->withType("danger");
    }

    /**
     * @param CodeWarQuestion $codeWarQuestion
     * @param CodeWarAnswer $codeWarAnswer
     * @param Request $request
     */
    public function updateAnswer(CodeWarQuestion $codeWarQuestion, CodeWarAnswer $codeWarAnswer, Request $request)
    {
        if($codeWarAnswer->question != $codeWarQuestion)
        {
            abort(404);
        }
        if($request->user()->can('edit',$codeWarAnswer))
        {
            $this->validate($request, [
                'answer' => 'required'
                ],
                [
                    'answer.required' => "Answer can't be left blank"
                ]);

            $codeWarAnswer->answer = $request->answer;
            $codeWarAnswer->save();

            return redirect()->route('codewar.show',$codeWarQuestion->slug)->withNotification("Answer has been updated!")->withType("success");
        }
        return back()->withNotification("Sorry Buddy! You are not authorized")->withType("danger");
    }
}
