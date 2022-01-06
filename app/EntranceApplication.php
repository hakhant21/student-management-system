<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class EntranceApplication extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'entrance_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function matriculationDetail()
    {
        return $this->hasOne('App\MatriculationDetail', 'entrance_application_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\ProfileInformation', 'entrance_application_id', 'id');
    }

    public function images()
    {
        return $this->hasMany('App\Image', 'entrance_application_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = IdGenerator::generate([
                'table' => 'entrance_applications',
                'field' => 'code',
                'length' => 10,
                'prefix' => 'REG-',
            ]);
        });
    }

    public function submissions()
    {
        return $this->hasMany('App\EntranceApplicationSubmission', 'entrance_application_id', 'id');
    }

    public function activeSubmission()
    {
        return $this->submissions()->orderBy('created_at', 'DESC')->first();
    }
}
