<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Invoice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['code', 'user_id', 'invoiced_at', 'invoice_type', 'is_paid'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->code = IdGenerator::generate([
                'table' => 'invoices',
                'field' => 'code',
                'length' => 10,
                'prefix' => 'INV-',
            ]);
        });
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany('App\InvoiceDetail', 'invoice_id', 'id');
    }
}
