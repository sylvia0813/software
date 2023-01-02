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

    // 是否有服務過任何訂單
    public function orders()
    {
        return $this->hasManyThrough(Order::class, OrderWaiter::class, 'user_id', 'id', 'id', 'order_id');
    }

    // 服務生正在服務的桌號
    public function assignedOrders()
    {
        if ($this->role == 'waiter') {
            return $this->orders()->where(function ($query) {
                return $query->where('status', 'processing');
            })->get();
        }
        return [];
    }

    // 今日服務的訂單數量
    public function serveCountToday()
    {
        return $this->orders()->where(function ($query) {
            return $query->where('status', 'completed');
        })->whereDate('orders.created_at', date('Y-m-d'))->count();
    }
}