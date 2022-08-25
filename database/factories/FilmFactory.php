<?php

use Faker\Generator as Faker;

$factory->define(App\Film::class, function (Faker $faker) {
    $filmName = $faker->name;
    return [
    	'name' => $filmName,
    	'slug' => str_slug($filmName),
    	'description' => $faker->text,
    	'release_date' => $faker->date('Y-m-d'),
    	'rating' => $faker->numberBetween(1, 5),
    	'ticket_price' => $faker->numberBetween(1, 200),
    	'country_id' => $faker->numberBetween(1, 3),
    	'photo' => 'demo.jpg',
    ];
});
