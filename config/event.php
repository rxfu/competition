<?php

return [
    'listeners' => [
        Illuminate\Auth\Events\Login::class => [
            App\Listeners\LogSuccessfulLogin::class,
        ],
        Illuminate\Auth\Events\Failed::class => [
            App\Listeners\LogFailedLogin::class,
        ],
        Illuminate\Auth\Events\Logout::class => [
            App\Listeners\LogSuccessfulLogout::class,
        ],
        Illuminate\Auth\Events\Lockout::class => [
            App\Listeners\LogLockout::class,
        ],
    ],

    'observers' => [
        App\Entities\User::class,
        App\Entities\Role::class,
        App\Entities\Permission::class,
        App\Entities\Department::class,
        App\Entities\Gender::class,
        App\Entities\Subject::class,
        App\Entities\Education::class,
        App\Entities\Degree::class,
        App\Entities\Document::class,
        App\Entities\Review::class,
        App\Entities\Group::class,
        App\Entities\Setting::class,
    ],
];
