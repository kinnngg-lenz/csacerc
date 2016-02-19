<?php

namespace App\Http\Controllers;

use App\Alumini;
use App\CodeWarAnswer;
use App\CodeWarQuestion;
use App\Like;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class LikesController extends Controller
{
    protected $alumini;
    /**
     * @var CodeWarAnswer
     */
    protected $codeWarAnswer;
    /**
     * @var Like
     */
    protected $like;
    /**
     * @var Question
     */
    protected $question;
    /**
     * @var CodeWarQuestion
     */
    protected $codeWarQuestion;

    public function __construct(Like $like, Alumini $alumini, CodeWarAnswer $codeWarAnswer, Question $question, CodeWarQuestion $codeWarQuestion)
    {
        $this->middleware('auth',['except' => ['index', 'show']]);
        $this->alumini = $alumini;
        $this->codeWarAnswer = $codeWarAnswer;
        $this->like = $like;
        $this->question = $question;
        $this->codeWarQuestion = $codeWarQuestion;
    }

    public function likeCWA($war_id, $answer_id, Request $request)
    {
        //Find Answer with Current Id;
        $answer = $this->codeWarAnswer->findOrFail($answer_id);
        if(!$answer->likes()->where('user_id', $request->user()->id)->get()->isEmpty())
        {
            $answer->likes()->where('user_id', $request->user()->id)->first()->delete();
            return back()->withNotification('Success! You unliked '.$answer->user->name."'s answer");
        }

        $answer->likes()->create(['user_id' => $request->user()->id]);
        return back()->withNotification('Success! You liked '.$answer->user->name."'s answer");
    }

    public function likeCWQ($war_id, Request $request)
    {
        //Find Answer with Current Id;
        $question = $this->codeWarQuestion->findOrFail($war_id);
        if(!$question->likes()->where('user_id', $request->user()->id)->get()->isEmpty())
        {
            $question->likes()->where('user_id', $request->user()->id)->first()->delete();
            return back()->withNotification('Success! You unliked '.$question->title);
        }

        $question->likes()->create(['user_id' => $request->user()->id]);
        return back()->withNotification('Success! You liked '.$question->title);
    }

    public function likeQQ($question_id, Request $request)
    {
        //Find Answer with Current Id;
        $question = $this->question->findOrFail($question_id);
        if(!$question->likes()->where('user_id', $request->user()->id)->get()->isEmpty())
        {
            $question->likes()->where('user_id', $request->user()->id)->first()->delete();
            return back()->withNotification('Success! You unliked '.str_limit($question->question,50));
        }

        $question->likes()->create(['user_id' => $request->user()->id]);
        return back()->withNotification('Success! You liked '.str_limit($question->question,50));
    }
}
