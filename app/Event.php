<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'events';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'from', 'to', 'created_by'];

    public function dates()
    {
        return $this->hasMany('App\EventDate', 'event_id', 'id');
    }
}
