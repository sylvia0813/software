<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Meal;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Meal::insert([
            [
                'name' => '飯',
                'description' => '這是飯',
                'price' => 10,
                'stock' => 300,
                'image_url' => '/images/meals/rice.jpg',
            ],
            [
                'name' => '麵',
                'description' => '這是碗麵',
                'price' => 20,
                'stock' => 200,
                'image_url' => '/images/meals/noodle.jpg',
            ],
            [
                'name' => '點心',
                'description' => '這是?',
                'price' => 30,
                'stock' => 100,
                'image_url' => '/images/meals/cake.jpg',
            ],
        ]);
    }
}