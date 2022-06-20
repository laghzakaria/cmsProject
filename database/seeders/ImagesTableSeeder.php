<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $users=User::all();
        $posts=Post::all();
        
        // $nbUsers=$users->count();
        $nbPosts=$posts->count();

        Image::factory($nbPosts)->make()->each(
            function($image) use ($posts){
                // $i=0;
                // if($i<$nbUsers){
                //     $image->imageable_id=$users->random()->id;
                //     $image->imageable_type='App\Models\User';
                //     $i=$i+1;
                //     $image->save();
                // }
                $image->imageable_id=$posts->random()->id;
                $image->imageable_type='App\Models\Post';
                $image->save();
            }
        );
    }
}
