<?php

namespace Database\Seeders;

use App\Models\Dish;
use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i<10; $i++){
            Order::factory()->hasAttached(Dish::find(rand(1,10)), ['amount' => rand(1,10)])->create();
        }

    }
}
