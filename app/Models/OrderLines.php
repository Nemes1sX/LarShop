<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderLines extends Model
{
    use HasFactory;
    
    protected $fillable = ['order_id', 'name', 'quantity', 'price'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
