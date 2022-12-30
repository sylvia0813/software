<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function hasOrder($order_id)
    {
        return $this->hasOneThrough(Order::class, OrderWaiter::class, 'user_id', 'id', 'id', 'order_id')->where('order_id', $order_id)->exists();
    }
}