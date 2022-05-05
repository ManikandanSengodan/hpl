<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;


class MouRequest extends FormRequest
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
            "ship_to_party_code"     => "required",
            "customer_id"            => "required",
            "group_company"          => "required",
            "price_point"            => "required",
            "major_grade"            => "required",
            "css_period"             => "required",
            "mou_type"               => "required",
            "monthly_target"         => ["required","numeric"],
            "quarterly_target"       => ["required","numeric"],
            "annual_target"          => ["required","numeric"],
            "monthly_rate"           => ["required","numeric"],
            "quarterly_rate"         => ["required","numeric"],
            "annual_rate"            => ["required","numeric"],
            "region"                 => "required",
            "from_date"              => "required",
            "to_date"                => "required",
            "status"                 => "required",
            "address"                => "required",
        ];

        return $validation;
    }
    
}
