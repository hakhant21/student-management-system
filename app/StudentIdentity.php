<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class StudentIdentity extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'student_identities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'code',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = IdGenerator::generate([
                'table' => 'student_identities',
                'field' => 'code',
                'length' => 10,
                'prefix' => 'STD-',
            ]);
        });
    }
}
