<?php

use Faker\Generator as Faker;

$factory->define(App\Genre::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    	'created_at' => now(),
    	'updated_at' => now(),
    ];
});
