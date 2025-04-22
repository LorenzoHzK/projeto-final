<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
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

    // Um pedido pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Um pedido pertence a um endereço
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    // Um pedido pode ter um cupom (opcional)
    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'cupon_id');
    }

    // Um pedido tem vários itens
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}
