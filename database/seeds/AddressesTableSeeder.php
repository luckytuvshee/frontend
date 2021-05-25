<?php

use Illuminate\Database\Seeder;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Address::create([
            'user_id' => 2,
            'city_id' => 1,
            'district_id' => 1,
            'subdistrict_id' => 3,
            'receiver_name' => 'Taylor',
            'mobile_number' => '99990099',
            'details' => '1020-р байр 3 давхар 19р тоот'
        ]);
    }
}
