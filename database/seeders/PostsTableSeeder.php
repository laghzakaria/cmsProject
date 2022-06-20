<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        $categories=Category::all();
        Post::factory(50)->make()->each(
            function($post) use ($users,$categories){
                $post->user_id=$users->random()->id;
                $post->category_id=$categories->random()->id;
                $post->save();
            }
        );
    }
}
