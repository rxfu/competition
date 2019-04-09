<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsTableSeeder::class);
        $this->call(GendersTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(EducationsTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
    }
}
