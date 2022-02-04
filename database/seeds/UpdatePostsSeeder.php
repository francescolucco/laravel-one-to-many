<?php

use App\Category;
use Illuminate\Database\Seeder;
use App\Post;

class UpdatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        foreach ($posts as $post) {
            $post->category_id = Category::inRandomOrder()->first()->id;
            $post->update();
        }
    }
}
