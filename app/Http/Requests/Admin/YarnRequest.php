<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class YarnRequest extends FormRequest
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
            "supplier" => "required",
            "yarn_denier" => "required",
            "shade_No" => "required",
            "yarn_color" => "required",
            "color_shade" => "required",
            "notes" => "nullable",
        ];

        return $validation;
    }
}
