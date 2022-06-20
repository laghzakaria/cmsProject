<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagsCount=Tag::count();
        Post::each(function($post)use($tagsCount){
            //nambre of tags for each post
            $take=random_int(1,$tagsCount);
            //id of tags
            $tagsId=Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tagsId);
        });
    }
}
