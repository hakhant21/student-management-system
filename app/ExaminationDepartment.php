<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExaminationDepartment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'examination_departments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name']; 

    public function matriculationDetails()
    {
        return $this->hasMany('App\MatriculationDetail', 'examination_department_id', 'id');
    }
}
