<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Create seeder for country
    public function run()
    {
        factory(App\Country::class, 3)->create();
    }
}
