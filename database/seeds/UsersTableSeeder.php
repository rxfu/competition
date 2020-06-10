<?php

use App\Entities\User;
use App\Entities\Department;
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
            'username' => 'gxnuad',
            'password' => 'gxnu@5826059..',
            'name' => '超级管理员',
            'is_super' => true,
            'creator_id' => 1,
            'is_confirmed' => true,
            'department_id' => Department::whereName('广西师范大学')->first()->id,
        ]);

        foreach (['文科组', '理科组', '工科组', '思政组'] as $idx => $user) {
            User::create([
                'username' => $user,
                'password' => 'cq2020%%%',
                'name' => $user . '抽签',
                'creator_id' => 1,
                'group_id' => $idx + 1,
                'role_id' => config('setting.drawer'),
                'is_confirmed' => true,
            ]);
        }
        /*
        factory(App\Entities\User::class, 50)->create()->filter(function ($user) {
            return $user->role_id === config('setting.player');
        })->each(function ($user) {
            $user->document()->save(factory(App\Entities\Document::class)->make());
        });
        */
    }
}
