<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\CustomFieldGroup::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(10),
        'slug' => $faker->slug(1),
        'description' => $faker->realText(20),
        'isActive' => true,
        'conditions' => []
    ];
});
