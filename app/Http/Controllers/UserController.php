<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $users = $users->groupBy('role');
        return view('user.list', compact('users'));
    }

    public function update(Request $request, $user_id)
    {
        $name = $request->name;
        $sex = $request->sex;
        $age = $request->age;
        $role = $request->role;

        $user = User::find($user_id);
        $user->name = $name;
        $user->sex = $sex;
        $user->age = $age;
        $user->role = $role;
        $user->save();

        return redirect()->route('user.list')->with('success', '資料修改成功');
    }
}