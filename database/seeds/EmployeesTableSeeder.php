<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Super admin
        App\Employee::create([
            'email' => 'admin@gmail.com',
            'last_name' => 'Bat',
            'first_name' => 'Dorj',
            'mobile_number' => '98900990',
            'employee_type_id' => 1,
            'password' => Hash::make('secret123')
        ]);

        // Shipper
        App\Employee::create([
            'email' => 'nomin@gmail.com',
            'last_name' => 'Batsaikhan',
            'first_name' => 'Nomin',
            'mobile_number' => '90092299',
            'employee_type_id' => 2,
            'password' => Hash::make('secret123')
        ]);

        App\Employee::create([
            'email' => 'purev@gmail.com',
            'last_name' => 'Bat',
            'first_name' => 'Purev',
            'mobile_number' => '99880099',
            'employee_type_id' => 2,
            'password' => Hash::make('secret123')
        ]);
    }
}
