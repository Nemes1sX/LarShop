<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'order_id', 'series_no', 'link'];

    protected static function booted() : void
    {
        static::created(function (Invoice $invoice) {
           $invoice->series_no = str_pad('TEST-', 8, '0', STR_PAD_LEFT);
           $invoice->save();
        });
    }

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
