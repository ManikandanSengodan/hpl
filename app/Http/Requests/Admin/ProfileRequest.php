<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
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
            "company_name" => "required",
            "mobile_no" => "required|min:10|numeric",
            "email" => "required|email",
            "GSTIN" => "required",
            "type"  => ["required",Rule::unique('profiles')->ignore($this->profile)],
            "address" => "required",
            "account_name" => "required",
            "account_no" => "required",
            "IFSCCode" => "required",
            "bank_and_branch_name" => "required",
            "UPI_ID" => "required",
        ];

        if($this->isMethod("post"))
        {
            $validation["image"] = 'required|mimes:jpg,jpeg,bmp,png|max:5000';
        }

        if($this->isMethod("put"))
        {
            $validation["image"] = 'nullable|mimes:jpg,jpeg,bmp,png|max:5000';
        }

        return $validation;
    }

    public function messages()
    {
        return [
            "image.mimes"           => "This image supported format jpg,jpeg,bmp,png",
            "image.max"             => "Image should be less than 5mb",
        ];
    }
}
