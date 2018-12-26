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

    $users = \App\Models\User::select('userID')->inRandomOrder()->first();

    $featuredImage = factory(App\Models\Media::class)->create()->makeThumb(200, 200);

    return [
      'createdByUserID' => ($users ? $users->userID : null),
      'profileImageID' => $featuredImage->mediaID,
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
    ];
});
