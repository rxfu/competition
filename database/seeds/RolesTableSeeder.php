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
            'slug' => 'manager',
            'name' => '院校管理员',
        ]);
        Role::create([
            'slug' => 'marker',
            'name' => '评委',
        ]);
        Role::create([
            'slug' => 'player',
            'name' => '选手',
        ]);
        Role::create([
            'slug' => 'drawer',
            'name' => '抽签',
        ]);
    }
}
