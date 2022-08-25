<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
    	'comment' => $faker->sentence,
    	'user_id' => $faker->numberBetween(1, 3),
    	'film_id' => $faker->numberBetween(1, 3),
    	'created_at' => now(),
    	'updated_at' => now(),
    ];
});
