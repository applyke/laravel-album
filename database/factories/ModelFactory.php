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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Album::class, function (Faker\Generator $faker) {

    return [
        'title' => $faker->sentence,
        'description' => $faker->text(),

    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Model\Image::class, function (Faker\Generator $faker) {

    return [
        'album_id' =>  factory(App\Model\Album::class)->create()->id ,
        'file' => $faker->imageUrl( $width = 640, $height = 480),

    ];
});