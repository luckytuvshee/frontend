<?php

use Illuminate\Database\Seeder;

class SubdistrictsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Subdistrict::create([
            'district_id' => 1, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 1, // foreign
            'subdistrict_name' => '2-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 1, // foreign
            'subdistrict_name' => '3-р хороо',
        ]);

        // Баянзүрх
        App\Subdistrict::create([
            // subdistrict id 4
            'district_id' => 2, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            // subdistrict id 5
            'district_id' => 2, // foreign
            'subdistrict_name' => '2-р хороо',
        ]);

        // 
        App\Subdistrict::create([
            'district_id' => 3, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 3, // foreign
            'subdistrict_name' => '2-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 4, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 5, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 6, // foreign
            'subdistrict_name' => '1-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 6, // foreign
            'subdistrict_name' => '2-р хороо',
        ]);

        App\Subdistrict::create([
            'district_id' => 6, // foreign
            'subdistrict_name' => '3-р хороо',
        ]);
    }
}
