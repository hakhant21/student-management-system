<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function application()
    {
        return $this->hasOne('App\EntranceApplication', 'user_id', 'id');
    }

    public function profile()
    {
        return $this->hasOne('App\ProfileInformation', 'user_id', 'id');
    }

    public function confirmedStudy()
    {
        return $this->hasOne('App\StudentStudy', 'user_id', 'id');
    }

    public function code()
    {
        return $this->hasOne('App\StudentIdentity', 'user_id', 'id');
    }

    public function enrollments()
    {
        return $this->hasMany('App\Enrollment', 'user_id', 'id');
    }

    public function activeEnrollment()
    {
        return $this->enrollments()->orderBy('created_at', 'DESC')->first();
    }

    public function studentId()
    {
        $code = $this->code()->first();

        if (!empty($code)) {
            return $code->code;
        }
    }

    public function invoice()
    {
        return $this->hasOne('App\Invoice', 'user_id', 'id');
    }

    public function majorChangeHistories()
    {
        return $this->hasMany('App/MajorChangeHistory', 'user_id', 'id');
    }
}
