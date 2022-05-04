<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineMasterRequest extends FormRequest
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
            "name" => "required|max:200",
            "colour" => "required",
            "operator_designated" => "required|max:200",
        ];
    }
}
