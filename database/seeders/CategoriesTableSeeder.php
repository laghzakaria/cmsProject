<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        Category::factory(20)->make()->each(
            function($category) use ($users){
                $category->user_id=$users->random()->id;
                $category->save();
            }
        );
    }
}
