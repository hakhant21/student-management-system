<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventDate extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'event_dates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['event_id', 'date'];

    public function event()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }
}
