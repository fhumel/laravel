<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password?: $password =bcrypt('secret'),
        'decsription' => str_random(10)
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'user_id' => App\User::all()->random()->id,
        'name' => $faker->word,
        'price' => $faker->randomFloat(2,1,100),
        'decsription' => $faker->paragraph(random_int(1,10))
    ];
});
