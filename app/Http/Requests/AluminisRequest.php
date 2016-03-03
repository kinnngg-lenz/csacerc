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
            'speaker' => 'required|min:5',
            'speech' => '',
            'profession' => 'required|min:5',
            'batch' => 'required|min:2',
            'organisation_id' => 'exists:organisations,id',
            'photo' => 'required|image',
            'email' => 'required|email',
            'facebook' => '',
            'department_id' => 'required|exists:departments,id',
        ];
    }
}
