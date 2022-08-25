<?php

use Illuminate\Database\Seeder;

class FilmGenreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\FilmGenre::class, 3)->create();
    }
}
