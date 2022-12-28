<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderMeal;

class OrderMealController extends Controller
{
    public function processing($order_meal_id)
    {
        $order_meal = OrderMeal::find($order_meal_id);
        $order_meal->status = 'processing';
        $order_meal->save();

        return redirect()->back();
    }

    public function finish($order_meal_id)
    {
        $order_meal = OrderMeal::find($order_meal_id);
        $order_meal->status = 'finish';
        $order_meal->save();

        return redirect()->back();
    }
}