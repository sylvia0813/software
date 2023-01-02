<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'status'
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}