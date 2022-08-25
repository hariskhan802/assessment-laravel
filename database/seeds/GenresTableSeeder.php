<?php

use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Create seeder for genre
    public function run()
    {
        factory(App\Genre::class, 10)->create();
    }
}
