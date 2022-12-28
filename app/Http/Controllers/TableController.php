<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class TableController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('table.status', compact('tables'));
    }

    public function update(Request $request, $table_id){
        $capacity = $request->capacity;
        $status = $request->status;
        $table = Table::find($table_id);
        $table->capacity = $capacity;
        $table->status = $status;
        $table->save();

        return redirect()->route('table.status')->with('success', '桌面狀態更新成功');
    }
}
