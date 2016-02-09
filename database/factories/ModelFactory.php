<?php

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
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'username' => $faker->userName,
        'dob' => $faker->date('Y-m-d', '-10 years'),
        'gender' => $faker->randomElement(['Male', 'Female']),
        'about' => $faker->paragraph(),
        'password' => bcrypt('kinnngg'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Alumini::class, function (Faker\Generator $faker) {
    return [
        'speech' => $faker->paragraph(),
        'speaker' => $faker->name,
        'batch' => $faker->words(3),
        'profession' => $faker->company,
        'user_id' => App\User::class,
        'slug' => $faker->slug(8),
    ];
});