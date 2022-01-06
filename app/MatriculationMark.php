<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatriculationMark extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'matriculation_marks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'matriculation_detail_id',
        'user_id',
        'subject_id',
        'mark'
    ];

    public function subject()
    {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function matriculationDetail()
    {
        return $this->belongsTo('App\MatriculationDetail', 'matriculation_detail_id', 'id');
    }
}
