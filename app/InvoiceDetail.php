<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoice_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['invoice_id', 'item', 'cost'];

    public function invoice()
    {
        return $this->belongsTo('App\Invoice', 'invoice_id', 'id');
    }
}
