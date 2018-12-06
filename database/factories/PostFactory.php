<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title'     => $faker->text(15),
        'content'   => $faker->text(200),
    ];
});

$factory->define(App\Details::class, function (Faker $faker) {
    return [
        'status'        => $faker->randomElement(['publicado', 'rascunho']),
        'visibility'    => $faker->randomElement(['publico', 'privado']),
    ];
});
