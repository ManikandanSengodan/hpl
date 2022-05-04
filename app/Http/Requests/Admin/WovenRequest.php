<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class WovenRequest extends FormRequest
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
            "customer_id"           => "required",
            "label"                 => "required",
            // "date"                  => "required",
            // "salesrep_id"           => "required",
            "front_crop_image"      => "nullable|mimes:jpg,jpeg,png|max:5000",
            "back_crop_image"       => "nullable|mimes:jpg,jpeg,png|max:5000",
            "all_view_crop_image"   => "nullable|mimes:jpg,jpeg,png|max:5000",
            "design_files"          => "nullable",
            "design_files.*"        => "max:25000",
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            "customer_id.required"          => "Select customer is required",
            "label.required"                => "Label is required",
            "date.required"                 => "Date is required",
            "salesrep_id.required"          => "Select sales rep is required",
            "front_crop_image.mimes"        => "Front image supported format jpg, jpeg & png",
            "front_crop_image.max"          => "Front image should be less than 5mb",
            "back_crop_image.mimes"         => "Back image supported format jpg, jpeg & png",
            "back_crop_image.max"           => "Back image should be less than 5mb",
            "all_view_crop_image.mimes"     => "All view image should be less than 5mb",
            "all_view_crop_image.max"       => "All view image supported format jpg, jpeg & png",
            "design_files.*.max"            => "Design file should be less than 25mb",
        ];
    }
}
