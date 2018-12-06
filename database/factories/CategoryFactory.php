<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->text(15),
        'description'   => $faker->text(200)
    ];
});
