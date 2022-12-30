<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Table;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderMeal;
use App\Models\OrderWaiter;

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
            'meals.*' => 'nullable|integer',
            'remark.*' => 'nullable|string',
        ], [
            'meals.required' => '請選擇餐點',
            'meals.array' => '餐點格式錯誤',
            'meals.*.integer' => '餐點格式錯誤',
            'meals.*.min' => '餐點數量錯誤',
            'remark.*' => '備註格式錯誤',
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
        // 餐點備註
        $remark = $request->remark;

        // 儲存訂單
        $order = new Order();
        $order->table_id = $table->id;
        $order->save();

        // 變更桌號狀態
        $table->status = 'occupied';
        $table->save();

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

        return redirect()->route('home')->with('success', '訂單已送出');
    }

    public function list()
    {
        $orders = Order::with([
            'table',
            'meals',
            'meals.meal',
        ])->orderBy('id', 'desc')->get();

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
            $meal->status = 'canceled';
            $meal->save();
        });

        $order->table->status = 'uncleaned';
        $order->table->save();

        $order->status = 'completed';
        $order->save();

        return redirect()->route('home')->with('success', '結帳成功');
    }

    public function waiters($order_id)
    {
        $order = Order::find($order_id);

        $waiters = User::where('role', 'waiter')->get();

        $group_waiters = $waiters->groupBy(function ($item) use ($order_id) {
            return $item->hasOrder($order_id) ? 'assign' : 'unassign';
        });

        return view('order.waiters', compact('order', 'group_waiters'));
    }

    public function assignWaiter($order_id, $waiter_id)
    {
        OrderWaiter::updateOrCreate([
            'order_id' => $order_id,
            'user_id' => $waiter_id,
        ], [
            'order_id' => $order_id,
            'user_id' => $waiter_id,
        ]);

        return redirect()->route('order.waiters', $order_id)->with('success', '服務員已指派');
    }

    public function unassignWaiter($order_id, $waiter_id)
    {
        OrderWaiter::where([
            'order_id' => $order_id,
            'user_id' => $waiter_id,
        ])->delete();

        return redirect()->route('order.waiters', $order_id)->with('success', '服務員已取消指派');
    }
}