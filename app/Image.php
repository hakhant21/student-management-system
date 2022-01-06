<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'image_type_id',
        'entrance_application_id',
    ];

    public function imageType()
    {
        return $this->belongsTo('App\ImageType', 'image_type_id', 'id');
    }

    public function entranceApplication()
    {
        return $this->belongsTo('App\EntranceApplication', 'entrance_application_id', 'id');
    }
}
