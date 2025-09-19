<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // User::truncate();
        // Post::truncate();
        Category::truncate();

        Schema::enableForeignKeyConstraints();

        User::factory()->create([
            'name' => 'Tango',
            'username' => 'sticky',
            'email' => 'tango@gmail.com',
        ]);

        $categories = ['Technology', 'Animal', 'Movie', 'Food', 'Games', 'Esports'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        // Post::factory(100)->create();
    }
}
