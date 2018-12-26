<?php

use Faker\Generator as Faker;
use \App\Models\Language;
use \App\Models\User;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    $data = [
        'postTypeID' => '',
        'order' => 1,
        'createdByUserID' => User::all()->random()->userID,
    ];

    foreach (Language::all() as $language){
        $data['title'][$language->slug] = $faker->text(10);
        $data['description'][$language->slug] = $faker->paragraphs(2, true);
        $data['slug'][$language->slug] = $faker->slug(1);
        $data['isVisible'][$language->slug] = true;
    }

    return $data;
});
