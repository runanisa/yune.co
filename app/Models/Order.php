<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status',
        'total',
        'paid',
        'change',
    ];

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
