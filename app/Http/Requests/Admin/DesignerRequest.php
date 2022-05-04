<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DesignerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validation = [
            "name"                  => "required|min:4|max:50",
            "email"                 => ["required","email",Rule::unique('staf_masters')->ignore($this->staff)],
            "phone"                 => ["required","min:10","numeric",Rule::unique('staf_masters')->ignore($this->staff)],
            "qualification"         => "required",
            "role_id"               => "required",
            "joined_on"             => "required",
            "status"                => "required",
            "blood_group"           => "nullable",
            "documentID"            => "nullable",
            "left_on"               => "nullable",
            "address"               => "nullable",
        ];

        if($this->isMethod("post")){
            $validation['password'] = 'required|confirmed|min:8';
        }

        if($this->isMethod("put")){
            $validation['password'] = 'nullable|confirmed|min:8';
        }

        return $validation;
    }


    public function messages()
    {
        return [
            "email.unique"  => "This email already exists",
            "phone.unique"  => "This mobile number already exists",
            "password.regex" =>
                "Password must be minimum 8 character and should contain atleast one number and a special character",
        ];
    }
}
