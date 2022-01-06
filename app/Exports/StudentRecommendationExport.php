<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentRecommendationExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function view(): View
    {
        $enrollment = $this->user->enrollments()->orderBy('created_at', 'DESC')->first();

        $recommendInfo = [
            'image' => $this->user->image,
            'name_title' => $this->user->profile->name_title_mm,
            'name' => $this->user->profile->name_mm,
            'nrc' => implode('/', json_decode($this->user->profile->nrc_mm, true)),
            'birthday' => $this->user->profile->date_of_birth,
            'father_name_title' => $this->user->profile->father_name_title_mm,
            'father_name' => $this->user->profile->father_name_mm,
            'academic_year' => $enrollment->academic_year_from . '-' .$enrollment->academic_year_to,
            'study' => $this->user->confirmedStudy->study->name,
            'roll_number' => $enrollment->roll_number,
            'id' => $this->user->studentId(),
        ];

        return view('admin.students.recommendation', [
            'recommendInfo' => $recommendInfo
        ]);
    }
}
