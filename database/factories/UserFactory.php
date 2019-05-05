<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Entities\User::class, function (Faker $faker) {
    return [
        'username' => $faker->unique()->randomNumber(),
        'name' => $faker->name,
        'password' => '123456',
        'remember_token' => Str::random(10),
        'role_id' => $faker->numberBetween(2, 3),
        'department_id' => $faker->numberBetween(1, 36),
        'group_id' => $faker->numberBetween(1, 4),
    ];
});

$factory->define(App\Entities\Document::class, function (Faker $faker) {
    return [
        'year' => date('Y'),
    ];
});
