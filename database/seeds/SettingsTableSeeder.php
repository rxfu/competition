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
            'name' => '教学比赛系统',
            'slug' => 'contest2019',
            'begin_at' => '2019-05-27 00:00:00',
            'end_at' => '2019-06-07 00:00:00',
            'year' => '2019',
        ]);
    }
}
