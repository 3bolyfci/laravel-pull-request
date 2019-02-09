<?php

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

$factory->define(App\Photo::class, function (Faker $faker) {
    return [
        'image_url' => $faker->imageUrl(),
        'post_id' => $faker->randomElement(\App\Post::pluck('id')->toArray()),
    ];
});
