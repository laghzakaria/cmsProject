<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=Post::all();
        $users=User::all();
        Comment::factory(300)->make()->each(
               function($comment)use($posts,$users){
                   $comment->user_id=$users->random()->id;
                   $comment->post_id=$posts->random()->id;
                   $comment->save();
               }
        );
    }
}
