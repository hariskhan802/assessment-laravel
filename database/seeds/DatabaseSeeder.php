<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \DB::table('users')->insert([
        	[
        		'name' => 'Haris',
        		'email' => 'haris@abc.com',
        		'password' => bcrypt('haris123'),
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	
        	
        ]);
        \DB::table('countries')->insert([
        	[
        		'name' => 'Pakistan',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'India',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'UK',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'US',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	
        ]);
        \DB::table('genres')->insert([
        	[
        		'name' => 'Action',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Drama',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Comedy',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	
        ]);
        \DB::table('genres')->insert([
        	[
        		'name' => 'Action',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Drama',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Comedy',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	
        ]);

        \DB::table('films')->insert([
        	[
        		'name' => 'Film 1',
        		'slug' => 'film-1',
        		'description' => 'Quia ullam quia amet',
        		'release_date' => '2023-02-01',
        		'rating' => '4',
        		'ticket_price' => 43,
        		'country_id' => '1',
        		'photo' => 'demo.jpg',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Film 2',
        		'slug' => 'film-2',
        		'description' => 'Quia ullam quia amet',
        		'release_date' => '2023-02-01',
        		'rating' => '4',
        		'ticket_price' => 50,
        		'country_id' => '3',
        		'photo' => 'demo.jpg',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'name' => 'Film 3',
        		'slug' => 'film-3',
        		'description' => 'Quia ullam quia amet',
        		'release_date' => '2023-02-01',
        		'rating' => '4',
        		'ticket_price' => 60,
        		'country_id' => '2',
        		'photo' => 'demo.jpg',
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	
        ]);

        \DB::table('film_genre')->insert([
        	[
        		'film_id' => 1,
        		'genre_id' => 1,
        	],
        	[
        		'film_id' => 1,
        		'genre_id' => 2,
        	],
        	[
        		'film_id' => 2,
        		'genre_id' => 1,
        	],
        	[
        		'film_id' => 3,
        		'genre_id' => 1,
        	],
        	[
        		'film_id' => 3,
        		'genre_id' => 2,
        	],
        	[
        		'film_id' => 3,
        		'genre_id' => 3,
        	],
        	
        ]);

        \DB::table('comments')->insert([
        	[
        		'comment' => 'Awesome Movie',
        		'film_id' => 1,
        		'user_id' => 1,
        		'created_at' => now(),
        		'updated_at' => now(),
        	],
        	[
        		'comment' => 'Best movie',
        		'film_id' => 2,
        		'user_id' => 1,
        		'created_at' => now(),
        		'updated_at' => now()
        	],
        	[
        		'comment' => 'Flop Movie',
        		'film_id' => 3,
        		'user_id' => 1,
        		'created_at' => now(),
        		'updated_at' => now()
        	],

        ]);
    }
}
