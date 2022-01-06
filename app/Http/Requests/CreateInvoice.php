<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoice extends FormRequest
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
            'invoice_date' => 'required',
            'invoice_type' => 'required',
            'user_id' => 'required|exists:enrollments,user_id',
            'details' => 'required|array',
            'details.*.item' => 'required|string|unique:invoice_details,item,invoice_id',
            'details.*.cost' => 'required|numeric',
        ];
    }
}
