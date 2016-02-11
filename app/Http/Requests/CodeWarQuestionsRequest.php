<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CodeWarQuestionsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->isAdmin())
            return true;

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
            'title' => 'required|min:10|unique:code_war_questions',
            'description' => 'min:20',

            /**
             * @TODO: Change this to validate for time and date too
             */
            'ends_at' => 'date'
        ];
    }
}
