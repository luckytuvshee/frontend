<?php

use Illuminate\Database\Seeder;

class EmployeeTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\EmployeeType::create([
            'name' => 'Админ',
            'description' => 'Системийг хариуцсан Superadmin, бусад ажилчдыг шинээр бүртгэнэ'
        ]);

        App\EmployeeType::create([
            'name' => 'Хүргэлтийн ажилтан',
            'description' => 'Захиалсан барааг хүргэнэ'
        ]);
    }
}
