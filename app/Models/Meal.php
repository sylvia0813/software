<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    // 當日銷售數量
    public function salesCountToday()
    {
        return $this->hasMany(OrderMeal::class)->whereDate('created_at', date('Y-m-d'))->sum('count');
    }

    // 當日銷售金額
    public function salesPriceToday()
    {
        $price = $this->price;
        $count = $this->salesCountToday();
        return $price * $count;
    }
}