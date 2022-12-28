<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;

class HomeController extends Controller
{
    public function index()
    {
        $tables = Table::all();
        return view('home', compact('tables'));
    }
}
