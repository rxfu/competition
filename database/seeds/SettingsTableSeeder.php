<?php

use App\Entities\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'name' => '第七届全区高校青年教师教学竞赛',
            'slug' => 'contest2020',
            'begin_at' => '2020-06-15 00:00:00',
            'end_at' => '2020-06-20 00:00:00',
            'year' => '2020',
        ]);
    }
}
