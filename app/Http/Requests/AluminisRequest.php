<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class AluminisRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->user()->role > 0)
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
            'speaker' => 'required|min:5',
            'speech' => 'required|min:100|max:5000',
            'profession' => 'required|min:5',
            'batch' => 'required|min:2',
        ];
    }
}
