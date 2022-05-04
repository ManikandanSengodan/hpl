<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoomRequest extends FormRequest
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
            "loom_name" => "required",
            "weaving_width_Meter" => "required",
            "sections" => "required",
            "speed" => "required",
            "year" => "required",
            "notes" => "nullable",
        ];
    }
}
