<?php

use App\Entities\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => '院校管理员',
        ]);
        Role::create([
            'name' => '评委',
        ]);
        Role::create([
            'name' => '选手',
        ]);
    }
}
