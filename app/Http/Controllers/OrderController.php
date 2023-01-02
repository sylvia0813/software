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
        $order->status = 'processing';
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

        // 自動指派一名服務員
        $waiter = $this->getRandomAssignWaiter();

        $orderWaiter = new OrderWaiter();
        $orderWaiter->order_id = $order->id;
        $orderWaiter->user_id = $waiter->id;
        $orderWaiter->save();

        return redirect()->route('home')->with('success', '訂單已送出');
    }

    // 隨機指派一名服務員，優先指派空閒中的服務員
    private function getRandomAssignWaiter()
    {
        // 列出所有服務員與當前服務訂單
        $waiters = User::with([
            'orders' => function ($query) {
                return $query->isProcessing();
            }
        ])->where('role', 'waiter')->get();

        // 對服務員排序，依服務中的訂單數量排序
        $waiters = $waiters->sortBy(function ($item) {
            return $item->orders->count();
        });

        // 對排序過的服務員進行分組，依服務中的訂單數量分組
        $waiters = $waiters->groupBy(function ($item) {
            return $item->orders->count();
        });

        // 第一組為空閒中或當前服務訂單最少的服務員，對其進行隨機選擇一名作為本次訂單的服務員
        $waiter = $waiters->first()->random();

        return $waiter;
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

    public function delete($order_id)
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

        $order->status = 'canceled';
        $order->save();

        return redirect()->route('home')->with('success', '訂單已刪除');
    }
}