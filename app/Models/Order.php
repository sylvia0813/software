<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function meals()
    {
        return $this->hasMany(OrderMeal::class);
    }

    public function scopeIsProcessing($query)
    {
        return $query->where('status', 'processing');
    }

    public function waiters()
    {
        return $this->hasManyThrough(User::class, OrderWaiter::class, 'order_id', 'id', 'id', 'user_id');
    }
}