<?php

use Faker\Generator as Faker;
use \App\Models\User;
use \App\Models\Language;

$factory->define(App\Models\Tag::class, function (Faker $faker) {
    $featuredImage = factory(App\Models\Media::class)->create()->makeThumb(200, 200);

    $data = [
        'postTypeID' => '',
        'createdByUserID' => User::all()->random()->userID,
        'featuredImageID' => $featuredImage->mediaID,
        'title' => $faker->text(10),
        'description' => $faker->paragraphs(2, true),
        'slug' => substr($faker->slug, 0, 55),
        'created_at' => new DateTime(),
        'updated_at' => new DateTime(),

    ];

    return $data;
});
