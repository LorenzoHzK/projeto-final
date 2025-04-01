<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'user_id',
        'address_id',
        'orderDate',
        'cupon_id',
        'status',
        'price'
    ];
    use HasFactory;
}
