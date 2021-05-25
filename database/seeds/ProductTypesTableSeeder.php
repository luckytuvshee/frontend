<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\ProductType::create([
            'type_name' => 'Арьс арчилгаа',
        ]);

        App\ProductType::create([
            'type_name' => 'Бие арчилгаа',
        ]);

        App\ProductType::create([
            'type_name' => 'Будалтын бүтээгдэхүүн',
        ]);

        App\ProductType::create([
            'type_name' => 'Үнэртэн',
        ]);

        App\ProductType::create([
            'type_name' => 'Үс арчилгаа',
        ]);
    }
}
