<?php

use App\Entities\Education;
use Illuminate\Database\Seeder;

class EducationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Education::create([
            'name' => '无',
        ]);
        Education::create([
            'name' => '本科',
        ]);
        Education::create([
            'name' => '硕士研究生',
        ]);
        Education::create([
            'name' => '博士研究生',
        ]);
    }
}
