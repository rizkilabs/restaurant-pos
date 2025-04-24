<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'order_detail',
        'order_amount',
        'order_status',
        'order_change'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class);
    }

}
