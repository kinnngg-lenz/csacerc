<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventsRequest extends Request
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
            'name' => 'required|min:3',
            'date' => 'required|date',
            'description' => 'required|min:10',
            'venue' => 'required',
            'photo' => 'required|image',
        ];
    }
}
