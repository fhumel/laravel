<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\User; // Assuming this is your User Model class with namespace.
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
$factory->define(Product::class, function (Faker $faker) {

    return [
        'user_id' => User::all()->random()->id,
        'name' => $faker->word,
        'price' => $faker->randomFloat(2,1,100),
        'description' => $faker->paragraph(random_int(1,10)),
    ];
});
