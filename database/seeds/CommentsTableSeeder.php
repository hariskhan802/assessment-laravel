<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Create seeder for comment
    public function run()
    {
        factory(App\Comment::class, 3)->create();
    }
}
