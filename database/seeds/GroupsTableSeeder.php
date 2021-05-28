<?php

use App\Entities\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => '文科组',
        ]);
        Group::create([
            'name' => '理科组',
        ]);
        Group::create([
            'name' => '工科组',
        ]);
        Group::create([
            'name' => '医科组',
        ]);
        Group::create([
            'name' => '思政组',
        ]);
    }
}
