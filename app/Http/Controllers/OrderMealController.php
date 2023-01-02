<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderMeal;

use App\Models\Meal;
use App\Models\Order;

class OrderMealController extends Controller
{
    public function processing($order_id, $meal_id)
    {
        $order_meal = OrderMeal::find($meal_id);
        $order_meal->status = 'processing';
        $order_meal->save();

        return redirect()->back()->with('success', '餐點狀態已更新');
    }

    public function finish($order_id, $meal_id)
    {
        $order_meal = OrderMeal::find($meal_id);
        $order_meal->status = 'finish';
        $order_meal->save();

        return redirect()->back()->with('success', '餐點狀態已更新');
    }

    public function arrived($order_id, $meal_id)
    {
        $order_meal = OrderMeal::find($meal_id);
        $order_meal->status = 'arrived';
        $order_meal->save();

        return redirect()->back()->with('success', '餐點狀態已更新');
    }

    public function index($order_id)
    {
        $meals = Meal::all();
        return view('order.append.index', compact('order_id', 'meals'));
    }

    public function append(Request $request, $order_id)
    {
        $order = Order::find($order_id);

        $meals = collect($request->meals)->filter(function ($value) {
            return $value != null && $value > 0;
        })->map(function ($value, $key) {
            return [
                'meal_id' => $key,
                'count' => $value
            ];
        })->values();

        $remark = $request->remark;

        // 新增餐點訂單
        foreach ($meals as $index => $meal) {
            $orderMeal = new OrderMeal();
            $orderMeal->order_id = $order->id;
            $orderMeal->meal_id = $meal['meal_id'];
            $orderMeal->count = $meal['count'];
            $orderMeal->remark = $remark[$index];
            $orderMeal->save();
            Meal::find($meal['meal_id'])->decrement('stock', $meal['count']);
        }

        return redirect()->route('order.detail', $order_id)->with('success', '餐點已新增');
    }

    public function remove($order_id, $meal_id)
    {
        OrderMeal::find($meal_id)->delete();

        return redirect()->route('order.detail', $order_id)->with('success', '餐點已刪除');
    }
}