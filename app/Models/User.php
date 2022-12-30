<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'account',
        'password',
        'role',
    ];

    // 是否有服務指定的訂單
    public function hasOrder($order_id)
    {
        return $this->hasOneThrough(Order::class, OrderWaiter::class, 'user_id', 'id', 'id', 'order_id')->where('order_id', $order_id)->exists();
    }

    // 是否有服務任何訂單
    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderWaiter::class, 'user_id', 'id', 'id', 'order_id');
    }
}