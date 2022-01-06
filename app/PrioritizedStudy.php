<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrioritizedStudy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'prioritized_studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matriculation_detail_id',
         'study_id',
         'user_id',
         'priority',
         'priority_mm'
    ];

    public function matriculationDetail()
    {
        return $this->belongsTo('App\MatriculationDetail', 'matriculation_detail_id', 'id');
    }

    public function study()
    {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }
}
