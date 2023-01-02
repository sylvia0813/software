<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WaiterController extends Controller
{
    public function index()
    {
        $waiters = User::with([
            'orders' => function ($query) {
                return $query->where('status', 'processing');
            },
            'orders.table',
        ])->where('role', 'waiter')->get();

        return view('waiter.status', compact('waiters'));
    }
}