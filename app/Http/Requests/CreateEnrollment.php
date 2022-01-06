<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEnrollment extends FormRequest
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
            'user_id' => 'required|exists:student_study,user_id',
            'academic_year_from' => 'required|numeric',
            'academic_year_to' => 'required|numeric',
            'roll_number' => 'unique:enrollments,academic_year_from,academic_year_to,roll_number'
        ];
    }
}
