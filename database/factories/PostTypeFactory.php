<?php

use Faker\Generator as Faker;

$factory->define(App\Models\PostType::class, function (Faker $faker) {

    $name = $faker->words(2, true);
    $slug = 'post_'.str_replace('-','_',$faker->slug(1));

    // Make is it doesn't exist
    $check = \App\Models\PostType::where('slug',$slug)->get();
    if($check){
        $slug = 'post_'.str_replace('-','_',$faker->slug(1));
    }

    return[
        'name' => $name,
        'slug' => $slug,
        'createdByUserID' => 1,
        'fields' => [],
        'isVisible' => true,
        'hasCategories' => true,
        'hasTags' => true,
        'isCategoryRequired' => true,
        'isTagRequired' => true,
        'hasFeaturedImage' => true,
        'isFeaturedImageRequired' => false,
        'hasFeaturedVideo' => true,
        'isFeaturedVideoRequired' => false,
    ];
});