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
        'batch' => $faker->word,
        'profession' => $faker->company,
        'organisation_id' => $faker->randomElement([1,2,3,4,5,7]),
        'photo_id' => $faker->randomElement([1,2,3,4,5,7]),
        'email' => $faker->companyEmail,
        'facebook' => $faker->url,
        'user_id' => 1,
        'slug' => $faker->slug(8),
    ];
});

$factory->define(App\Event::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(3),
        'date' => $faker->dateTimeBetween('now','+1 year'),
        'description' => $faker->paragraph(3),
        'venue' => $faker->streetName,
        'user_id' => 1,
        'photo_id' => $faker->randomElement([1,2,3,4,5,7]),
        'slug' => $faker->slug(8),
    ];
});


$factory->define(App\News::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(10),
        'description' => $faker->paragraph(10),
        'user_id' => 1,
        'photo_id' => $faker->randomElement([1,2,3,4,5,7]),
        'slug' => $faker->slug(8),
    ];
});


$factory->define(App\Organisation::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'initials' => $faker->word,
        'details' => $faker->paragraph(10),
        'photo_id' => $faker->randomElement([1, 2, 3, 4, 5, 7]),
        'user_id' => 1,
        'address' => $faker->address,
        'slug' => $faker->slug(8),
    ];
});