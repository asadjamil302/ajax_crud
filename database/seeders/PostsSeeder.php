<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Posts;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 1000; $i++) {
            $post = new Posts();
            $post->title = 'Post ' . $i;
            $post->description = 'Description ' . $i;
            $post->image = 'placeholder.png';
            $post->active = 'Y';
            $post->save();
        }

    }
}
