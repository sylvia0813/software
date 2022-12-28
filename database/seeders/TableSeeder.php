<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Table;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Table::insert([
            [
                'name' => '桌號 1',
                'capacity' => 4,
                'status' => 'available',
            ],
            [
                'name' => '桌號 2',
                'capacity' => 4,
                'status' => 'available',
            ],
            [
                'name' => '桌號 3',
                'capacity' => 4,
                'status' => 'available',
            ],
            [
                'name' => '桌號 4',
                'capacity' => 4,
                'status' => 'available',
            ],
        ]);
    }
}
