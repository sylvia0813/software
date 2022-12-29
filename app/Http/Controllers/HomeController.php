<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class HomeController extends Controller
{
    public function index()
    {
        $tables = Table::with([
            'order',
        ])->get();

        return view('home', compact('tables'));
    }
}