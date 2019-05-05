<?php

use App\Entities\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => '123456',
            'name' => '超级管理员',
            'is_super' => true,
            'creator_id' => 1,
        ]);
        
        factory(App\Entities\User::class, 50)->create()->each(function ($user) {
            $user->document()->save(factory(App\Entities\Document::class)->make());
        });
    }
}
