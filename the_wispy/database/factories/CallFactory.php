<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Call;
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

$factory->define(Call::class, function (Faker $faker) {
    return [
        'number' => random(5),
        'device_id' => "122",
        'type' => 'MISSED',
        'duration' => '12', // password
        'name' => 'unknown',
    ];
});
