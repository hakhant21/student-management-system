<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentStudy extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_study';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'study_id',
        'acted_by'
    ];

    public function study()
    {
        return $this->belongsTo('App\Study', 'study_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
