<?php

use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        //
        'film_id' => $faker->numberBetween(1, 5),
        'film_id' => $faker->numberBetween(1, 5),
    ];
});
