<?php

use Illuminate\Database\Seeder;
// use UsersTableSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Excute seeder for demo data
        $this->call([
            UsersTableSeeder::class,
            GenresTableSeeder::class,
            CountriesTableSeeder::class,
            FilmsTableSeeder::class,
            FilmGenreTableSeeder::class,
        ]);
        
    }
}
