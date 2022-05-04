<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FoldRequest extends FormRequest
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
            "type_of_fold"  => "required",
            "minimum_mm"    => "required",
            "maximum_mm"    => "required",
            "notes"         => "nullable",
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
