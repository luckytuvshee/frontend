<?php

use Illuminate\Database\Seeder;

class OrderStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\OrderStatus::create([
            'order_status' => 'Захиалга хийгдсэн',
        ]);

        App\OrderStatus::create([
            'order_status' => 'Захиалга баталгаажсан',
        ]);

        App\OrderStatus::create([
            'order_status' => 'Бараа бэлтгэгдсэн',
        ]);

        App\OrderStatus::create([
            'order_status' => 'Хүргэлтэнд гарсан',
        ]);

        App\OrderStatus::create([
            'order_status' => 'Хүргэгдсэн',
        ]);
    }
}
