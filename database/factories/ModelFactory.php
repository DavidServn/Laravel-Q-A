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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'password' => 123
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'question' => $faker->paragraph,
        'room_id' => rand(App\Room::where('id', '>', -1)->min('id'), App\Room::where('id', '>', -1)->max('id'))
    ];
});