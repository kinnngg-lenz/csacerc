<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AnswerRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $question = \App\Question::findOrFail($this->question_id);

        if(!is_null($question->answer))
            return false;

        /**
         * If question is asked globally then any admin can Answer
         */
        if(is_null($question->for_user_id))
            return $this->user()->isAdmin() ? true : false;

        /**
         * If User is Answerer
         */
        return $this->user()->id == $question->for_user_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'answer' => 'required'
        ];
    }
}
