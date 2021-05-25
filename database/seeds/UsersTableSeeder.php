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
            'email' => 'guest@gmail.com',
            'last_name' => 'Guest',
            'first_name' => 'Guest',
            'password' => Hash::make('secret123')
        ]);

        App\User::create([
            'email' => 'user1@gmail.com',
            'last_name' => 'Bold',
            'first_name' => 'Bilguun',
            'mobile_number' => '88998800',
            'password' => Hash::make('secret123')
        ]);
    }
}
