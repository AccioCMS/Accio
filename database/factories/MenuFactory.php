<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Menu::class, function (Faker $faker) {
    return [
        'title' => $faker->text(10),
        'slug' => $faker->slug(1),
        'isPrimary' => 0
    ];
});