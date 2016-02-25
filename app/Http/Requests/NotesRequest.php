<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotesRequest extends Request
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
            'name' => 'required',
            'department_id' => 'required|exists:departments,id',
            'college_id' => 'required|exists:colleges,id',
            'semester' => 'required|in:0,1,2,3,4,5,6,7,8',
            'owner' => 'required',
            'file' => 'required|mimes:pdf',
        ];
    }
}
