<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    // Create seeder for user
    public function run()
    {
        factory(App\User::class, 3)->create();
    }
}
