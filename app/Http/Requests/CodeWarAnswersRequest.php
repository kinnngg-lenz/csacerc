<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CodeWarAnswersRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $question = \App\CodeWarQuestion::findOrFail($this->code_war_question_id);

        /**
         * User already submitted an Answer to this War
         */
        if(!is_null($question->answers()->where('user_id',$this->user()->id)->first()))
        {
            return false;
        }
        if($question->isOpen())
        {
            return true;
        }
        return false;
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
