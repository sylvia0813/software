<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => '測試帳號',
                'account' => 'test',
                'password' => Hash::make('1234'),
                'role' => 'admin',
            ],
            [
                'name' => '領檯人員',
                'account' => 'server',
                'password' => Hash::make('1234'),
                'role' => 'server',
            ],
            [
                'name' => '服務生',
                'account' => 'waiter',
                'password' => Hash::make('1234'),
                'role' => 'waiter',
            ],
            [
                'name' => '廚師',
                'account' => 'chef',
                'password' => Hash::make('1234'),
                'role' => 'chef',
            ],
            [
                'name' => '雜工',
                'account' => 'handyman',
                'password' => Hash::make('1234'),
                'role' => 'handyman',
            ],
            [
                'name' => '經理',
                'account' => 'manager',
                'password' => Hash::make('1234'),
                'role' => 'manager',
            ],
        ]);
        User::factory()->count(10)->create();
    }
}