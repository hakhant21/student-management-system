<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntranceApplicationSubmission extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entrance_application_submissions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['entrance_application_id', 'status', 'acted_by', 'is_expired'];

    public function application()
    {
        return $this->belongsTo('App\EntranceApplication', 'entrance_application_id', 'id');
    }
}
