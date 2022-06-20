<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        Tag::factory(20)->make()->each(
            function($tag) use ($users){
                $tag->user_id=$users->random()->id;
                $tag->save();
            }
        );
    }
}
