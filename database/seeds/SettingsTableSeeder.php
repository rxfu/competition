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
            'name' => '第八届全区高校青年教师教学竞赛',
            'slug' => 'contest2021',
            'begin_at' => '2021-06-01 00:00:00',
            'end_at' => '2021-06-08 00:00:00',
            'year' => '2021',
        ]);
    }
}
