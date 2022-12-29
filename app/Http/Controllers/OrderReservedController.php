<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Table;

class OrderReservedController extends Controller
{
    public function index($table_id)
    {
        $table = Table::find($table_id);
        $table->status = 'reserved';
        $table->save();

        return redirect()->route('home')->with('success', '訂位成功');
    }

    public function cancel($table_id)
    {
        $table = Table::find($table_id);
        $table->status = 'available';
        $table->save();

        return redirect()->route('home')->with('success', '訂位取消成功');
    }
}