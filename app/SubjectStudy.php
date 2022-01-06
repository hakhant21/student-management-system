<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectStudy extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'subject_studies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'subject_id',
        'study_id'
    ];

    public function study()
    {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }
}
