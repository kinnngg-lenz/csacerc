<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuotesRequest extends Request
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
            'speaker' => 'min:2',
            'text' => 'required|min:5|max:500|unique:quotes,text',
        ];
    }
}
