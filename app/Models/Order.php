<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => OrderStatus::AwaitingPayment,
        'country' => 'Lithuania'
    ];

    protected $fillable = ['full_name', 'email', 'city', 'country', 'postcode', 'address', 'status'];

    public function orderLines() : HasMany
    {
        return $this->hasMany(OrderLines::class);
    }

    public function invoice() : HasOne
    {
        return $this->hasOne(Invoice::class);
    }

}
