<?php

use Illuminate\Database\Seeder;

class FilmGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    // Create seeder for film genre
    public function run()
    {
        factory(App\FilmGenre::class, 10)->create();
    }
}
