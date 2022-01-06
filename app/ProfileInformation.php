<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileInformation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profile_information';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name_mm',
        'name_en',
        'name_title_mm',
        'name_title_en',
        'father_name_mm',
        'father_name_en',
        'father_name_title_mm',
        'father_name_title_en',
        'mother_name_mm',
        'mother_name_en',
        'mother_name_title_mm',
        'mother_name_title_en',
        'nrc_mm',
        'nrc_en',
        'father_death_status',
        'mother_death_status',
        'father_nrc_mm',
        'father_nrc_en',
        'mother_nrc_mm',
        'mother_nrc_en',
        'race',
        'father_race',
        'mother_race',
        'religion',
        'father_religion',
        'mother_religion',
        'date_of_birth',
        'father_date_of_birth',
        'mother_date_of_birth',
        'job',
        'father_job',
        'mother_job',
        'contact_phone',
        'father_contact_phone',
        'mother_contact_phone',
        'father_email',
        'mother_email',
        'address',
        'father_address',
        'mother_address',
        'entrance_application_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function application()
    {
        return $this->belongsTo('App\EntranceApplication', 'user_id', 'id');
    }
}
