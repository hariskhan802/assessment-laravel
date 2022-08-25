<?php

use Faker\Generator as Faker;
// Create factory for Genre
$factory->define(App\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    	'created_at' => now(),
    	'updated_at' => now(),
    ];
});
