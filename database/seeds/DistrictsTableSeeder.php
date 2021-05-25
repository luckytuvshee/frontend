<?php

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\District::create([
            'city_id' => 1,
            'district_name' => 'Баянгол',
        ]);

        App\District::create([
            'city_id' => 1,
            'district_name' => 'Баянзүрх',
        ]);

        App\District::create([
            'city_id' => 1,
            'district_name' => 'Сонгинохайрхан',
        ]);

        App\District::create([
            'city_id' => 1,
            'district_name' => 'Сүхбаатар',
        ]);

        App\District::create([
            'city_id' => 1,
            'district_name' => 'Хан-Уул',
        ]);

        App\District::create([
            'city_id' => 1,
            'district_name' => 'Чингэлтэй',
        ]);
    }
}
