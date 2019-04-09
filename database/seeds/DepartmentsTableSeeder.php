<?php

use App\Entities\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => '广西师范大学',
        ]);
        Department::create([
            'name' => '广西大学',
        ]);
        Department::create([
            'name' => '广西民族大学',
        ]);
    }
}
