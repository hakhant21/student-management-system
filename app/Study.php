<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','is_matriculation'];

    public function matriculationDetails()
    {
        return $this->hasMany('App\MatriculationDetail', 'study_id', 'id');
    }

    public function subjectStudies()
    {
        return $this->hasMany('App\SubjectStudy', 'study_id', 'id');
    }

    public function prioritizedStudies()
    {
        return $this->hasMany('App\PrioritizedStudy', 'study_id', 'id');
    }

}
