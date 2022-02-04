<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($c=0; $c < 100; $c++){
            
            $new_post = new Post();
            
            $new_post->title = $faker->sentence();
            $new_post->description = $faker->text();
            $new_post->slug = Post::generateSlug($new_post->title);
            
            dump($new_post->slug);
            $new_post->save();

        }
    }
}
