<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrganisationRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        /*if($this->user()->isAdmin())
            return true;

        return false;*/
        return true;
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
            'initials' => '',
            'details' => '',
            'photo' => 'required|image|max:250',
            'address' => '',
        ];
    }
}
