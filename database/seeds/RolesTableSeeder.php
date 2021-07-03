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
        $role = Role::create([
            'slug' => 'manager',
            'name' => '院校管理员',
        ]);
        $role->permissions()->sync([1, 10, 67, 68, 69, 70, 71, 72, 76, 78, 79, 80, 81, 85, 86, 87, 88, 89, 90, 91, 92, 98, 99, 100, 104, 105]);

        $role = Role::create([
            'slug' => 'marker',
            'name' => '评委',
        ]);
        $role->permissions()->sync([1, 96, 97, 101, 102, 104, 105]);

        Role::create([
            'slug' => 'player',
            'name' => '选手',
        ]);

        $role = Role::create([
            'slug' => 'drawer',
            'name' => '抽签',
        ]);
        $role->permissions()->sync([1, 73, 74, 75, 104, 105]);

        $role = Role::create([
            'slug' => 'sector',
            'name' => '抽节段',
        ]);
        $role->permissions()->sync([1, 82, 83, 84, 104, 105]);
    }
}
