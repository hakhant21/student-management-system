<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'image_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function images()
    {
        return $this->hasMany('App\Image', 'image_type_id', 'id');
    }
}
