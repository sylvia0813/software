<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Table;
use App\Models\Order;
use App\Models\OrderMeal;

class OrderController extends Controller
{
    public function index($table_id)
    {
        $meals = Meal::all();
        return view('order.index', compact('table_id', 'meals'));
    }

    public function new(Request $request, $table_id)
    {
        $request->validate([
            'meals' => 'required|array',
            'meals.*' => 'nullable|integer'
        ], [
            'meals.required' => '請選擇餐點',
            'meals.array' => '餐點格式錯誤',
            'meals.*.integer' => '餐點格式錯誤',
            'meals.*.min' => '餐點數量錯誤'
        ]);

        // 桌號
        $table = Table::find($table_id);
        // 餐點
        $meals = collect($request->meals)->filter(function ($value) {
            return $value != null && $value > 0;
        })->map(function ($value, $key) {
            return [
                'meal_id' => $key,
                'count' => $value
            ];
        })->values();

        // 儲存訂單
        $order = new Order();
        $order->table_id = $table->id;
        $order->save();

        // 變更桌號狀態
        $table->status = 'occupied';
        $table->save();

        // 新增餐點訂單
        foreach ($meals as $meal) {
            $orderMeal = new OrderMeal();
            $orderMeal->order_id = $order->id;
            $orderMeal->meal_id = $meal['meal_id'];
            $orderMeal->count = $meal['count'];
            $orderMeal->save();
            Meal::find($meal['meal_id'])->decrement('stock', $meal['count']);
        }

        return redirect()->route('home')->with('success', '訂單已送出');
    }

    public function list()
    {
        $orders = Order::with([
            'table',
            'meals',
            'meals.meal',
        ])->get();

        return view('order.list', compact('orders'));
    }

    public function detail($order_id)
    {
        $order = Order::with([
            'table',
            'meals',
            'meals.meal',
        ])->find($order_id);

        $total_price = $order->meals->sum(function ($order_meal) {
            return $order_meal->meal->price * $order_meal->count;
        });

        return view('order.detail', compact('order', 'total_price'));
    }

    public function checkout($order_id)
    {
        $order = Order::with([
            'table',
            'meals',
        ])->find($order_id);

        $order->meals->each(function ($meal) {
            $meal->status = 'cancelled';
            $meal->save();
        });

        $order->table->status = 'available';
        $order->table->save();

        $order->status = 'completed';
        $order->save();

        return redirect()->route('home')->with('success', '結帳成功');
    }
}