<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        Post::factory()->count(50)->create();

        $this->call([
            LikeSeeder::class,
            ShareSeeder::class,
            CommentSeeder::class,
            FollowersSeeder::class
        ]);

        $this->call([
            PostSeeder::class,
        ]);

       
    }
}
