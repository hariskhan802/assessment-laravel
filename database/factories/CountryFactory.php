<?php

use Faker\Generator as Faker;
// Create factory for country
$factory->define(App\Country::class, function (Faker $faker) {
    return [
        'name' => $faker->country,
    	'created_at' => now(),
    	'updated_at' => now(),
    ];
});
