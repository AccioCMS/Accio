<?php

use Faker\Generator as Faker;
use \App\Models\Language;

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password;
    // About
    $languages = Language::all();
    $about = [];
    foreach($languages as $language) {
        $about[$language->slug] = $faker->paragraph(rand(2,3));
    }

    $featuredImage = factory(App\Models\Media::class)->create();
    $mediaID =  $featuredImage->mediaID;

    return [
        'firstName' => $faker->name,
        'lastName' => $faker->lastName,
        'slug' => str_slug($faker->name."-".$faker->lastName),
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'phone' => $faker->phoneNumber,
        'country' => $faker->country,
        'street' => $faker->streetAddress,
        'about' => $about,
        'isActive' => true,
        'profileImageID' => $mediaID
    ];
});
