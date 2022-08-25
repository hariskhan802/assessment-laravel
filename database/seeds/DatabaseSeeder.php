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
        // $this->call('UsersTableSeeder');
        $this->call([
            UsersTableSeeder::class,
            GenresTableSeeder::class,
            CountriesTableSeeder::class,
            FilmsTableSeeder::class,
            FilmGenreTableSeeder::class,
            // CommentsTableSeeder::class,
            // GenresTableSeeder::class,
        ]);
        
    }
}
