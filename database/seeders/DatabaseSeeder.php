<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        Category::create([
            "name_category"=> "sports",
        ]);
        Category::create([
            "name_category"=> "technologies",
        ]);
        Category::create([
            "name_category"=> "politics",
        ]);
        Category::create([
            "name_category"=> "bussiness",
        ]);

        User::factory(5)->create();
        Post::factory(33)->create();

        // Post::factory(5)->create();
    }
}
