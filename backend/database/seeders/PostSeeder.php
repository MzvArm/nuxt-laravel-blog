<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

// Сидер наполняет базу тестовыми данными
class PostSeeder extends Seeder
{
    public function run(): void
    {
        Post::create([
            'title' => 'First post',
            'slug' => 'first-post',
            'content' => 'This is the first post content'
        ]);

        Post::create([
            'title' => 'Second post',
            'slug' => 'second-post',
            'content' => 'Another interesting story here'
        ]);
    }
}