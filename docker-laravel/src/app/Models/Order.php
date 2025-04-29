<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'orderDate',
        'coupon_id',
        'status',
        'totalAmount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'cupon_id');
    }

    public function OrderItem()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
