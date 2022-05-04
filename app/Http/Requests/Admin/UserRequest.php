<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            "name" => "required|min:4|max:50",
            "email" => "required|email|unique:users,email",
            "password" => 'required|confirmed|min:8',
            "phone" => 'required|min:10|numeric',
            "password_confirmation" => "required",
        ];

        if ($this->isMethod("put")) {
            $validation = [
                "name" => "required|alpha_num|min:4|max:50",
                "email" => "required|string|max:50|unique:users,email," . $this->route("user")->id,
                "password" => 'required|nullable|confirmed|min:8',
                'phone' => 'required|min:10|numeric',  
                "password_confirmation" => "required",
            ];
        }

        return $validation;
    }

    public function messages()
    {
        return [
            "password.regex" =>
                "Password must be minimum 8 character and should contain atleast one number and a special character",
        ];
    }
}
