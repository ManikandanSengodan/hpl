<?php

namespace App\Http\Requests\Auth;

use App\Rules\OldPasswordCheckRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            "old_password" => ["required", new OldPasswordCheckRule()],
            "password" => 'required|confirmed|min:8',
        ];
    }

    public function messages()
    {
        return [
            "password.regex" => "Password must be minimum 8 character",
        ];
    }
}
