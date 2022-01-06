<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_types' ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = ['name'] ;
}
