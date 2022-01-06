<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendationType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recommendation_types' ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name'] ;
    
}
