<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'email' => 'guest@myshop.com',
            'last_name' => 'Guest',
            'first_name' => 'Guest',
            'password' => Hash::make('12121212')
        ]);

        App\User::create([
            'email' => 'taylor@yahoo.com',
            'last_name' => 'Swift',
            'first_name' => 'Taylor',
            'mobile_number' => '99990019',
            'password' => Hash::make('12121212')
        ]);
    }
}
