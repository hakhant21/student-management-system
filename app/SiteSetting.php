<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'site_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'app_name',
        'logo',
        'address',
        'google_map_iframe',
        'phone',
        'email',
        'copyright_info',
        'digital_signature'
    ];
}
