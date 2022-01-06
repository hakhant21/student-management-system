<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatriculationDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matriculation_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'roll_number',
        'examination_department_id',
        'study_id',
        'entrance_application_id',
        'year'
    ];

    public function entranceApplication()
    {
        return $this->belongsTo('App\EntranceApplication', 'entrance_application_id', 'id');
    }

    public function examinationDepartment()
    {
        return $this->belongsTo('App\ExaminationDepartment', 'examination_department_id', 'id');
    }

    public function study()
    {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }

    public function matriculationMarks()
    {
        return $this->hasMany('App\MatriculationMark', 'matriculation_detail_id', 'id');
    }

    public function prioritizedStudies()
    {
        return $this->hasMany('App\PrioritizedStudy', 'matriculation_detail_id', 'id');
    }

    public function totalMarks()
    {
        return $this->matriculationMarks()->sum('mark');
    }
}
