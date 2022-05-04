<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FinishingMachineRequest extends FormRequest
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
            "machine" => "required",
            "folds_available" => "required",
            "min_end_fold" => "required",
            "max_length_mm" => "required",
            "speed" => "required",
            "year" => "required",
            "notes" => "nullable",
            "serial_Nos" => "required",
        ];
    }
}
