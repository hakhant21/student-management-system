<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'enrollments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'academic_year_from', 'academic_year_to', 'roll_number'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
