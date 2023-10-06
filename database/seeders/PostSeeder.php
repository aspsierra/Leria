<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = DB::table('posts')->select('id')->get();

        foreach ($posts as $post) {
            $n_likes = DB::table('likes')->where('post_id', $post->id)->count();
            $n_shares = DB::table('shares')->where('post_id', $post->id)->count();
            $n_comments = DB::table('comments')->where('post_id', $post->id)->count();

            DB::table('posts')
            ->where('id', $post->id)
            ->update([
                'n_likes'=> $n_likes,
                'n_shared' => $n_shares,
                'n_comments' => $n_comments
            ]);    
        }
    }
}
