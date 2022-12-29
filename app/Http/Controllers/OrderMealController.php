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

        return redirect()->back()->with('success', '餐點狀態已更新');
    }

    public function finish($order_meal_id)
    {
        $order_meal = OrderMeal::find($order_meal_id);
        $order_meal->status = 'finish';
        $order_meal->save();

        return redirect()->back()->with('success', '餐點狀態已更新');
    }

    public function arrived($order_meal_id)
    {
        $order_meal = OrderMeal::find($order_meal_id);
        $order_meal->status = 'arrived';
        $order_meal->save();

        return redirect()->back()->with('success', '餐點狀態已更新');
    }
}