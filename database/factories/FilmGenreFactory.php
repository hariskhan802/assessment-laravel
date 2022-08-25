<?php

use Faker\Generator as Faker;
// Create factory for FilmGenre
$factory->define(App\FilmGenre::class, function (Faker $faker) {
    return [
        //
        'film_id' => $faker->numberBetween(1, 3),
        'genre_id' => $faker->numberBetween(1, 10),
    ];
});
