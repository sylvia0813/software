<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class MealController extends Controller
{
    public function list()
    {
        $meals = Meal::all();

        return view('meal.list', compact('meals'));
    }

    public function update(Request $request, $meal_id)
    {
        $stock = $request->stock;

        $meal = Meal::find($meal_id);
        $meal->stock = $stock;
        $meal->save();

        return redirect()->route('meal.list')->with('success', '餐點庫存已更新');
    }
}