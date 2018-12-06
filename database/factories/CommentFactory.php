<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'title'     => $faker->text(15),
        'content'   => $faker->text(200),
        'post_id'   => function () {
            return factory(App\Post::class)->create()->id;
        }
    ];
});
