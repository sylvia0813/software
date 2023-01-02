<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $date = date('Y-m-d');
        $meals = Meal::all();

        // 當日總銷售數量
        $salesTotalCountToday = $meals->map(function ($item, $key) {
            return $item->salesCountToday();
        })->sum();

        // 當日總銷售金額
        $salesTotalPiceToday = $meals->map(function ($item, $key) {
            return $item->salesPriceToday();
        })->sum();

        $waiters = User::where('role', 'waiter')->get();

        return view('dashboard.index', compact('date', 'meals', 'salesTotalCountToday', 'salesTotalPiceToday', 'waiters'));
    }
}