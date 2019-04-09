<?php

use App\Entities\Subject;
use Illuminate\Database\Seeder;

class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::create([
            'name' => '文学',
        ]);
        Subject::create([
            'name' => '理学',
        ]);
        Subject::create([
            'name' => '工学',
        ]);
    }
}
