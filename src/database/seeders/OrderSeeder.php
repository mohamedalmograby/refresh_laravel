<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory(15)->create()->each(function ($order) {
            // For each order, create 3-5 order items
            $orderItemsCount = rand(3, 5);

            OrderItem::factory($orderItemsCount)->create([
                'order_id' => $order->id,
            ]);
        });
    }
}
