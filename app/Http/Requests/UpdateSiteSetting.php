<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSetting extends FormRequest
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
            'app_name' => 'required|string',
            'logo' => 'image',
            'digital_signature'=> 'image',
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'google_map_iframe' => 'required',
            'copyright_info' => 'required',
            'images' => 'array',
            'images.*' => 'max:2048',
            'old_images' => 'array',
            'old_images.*' => 'max:2048',
        ];
    }
}
