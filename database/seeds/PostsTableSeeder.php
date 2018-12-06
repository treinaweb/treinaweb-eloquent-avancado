<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Post::class)->create()->each(function ($post) {
            $post->comments()->saveMany(
                factory(App\Comment::class, 3)->make([
                    'post_id'   => $post->id
                ])
            );

            $post->categories()->save(
                factory(App\Category::class)->make()
            );

            $post->details()->save(
                factory(App\Details::class)->make()
            );
        });
    }
}
