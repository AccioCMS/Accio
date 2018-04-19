<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Language::class, function(Faker $faker) {
    $tmpFaker = null;
    while(true){
        $tmpFaker = \Faker\Factory::create();
        $lang = App\Models\Language::findBySlug($tmpFaker->languageCode);
        if($lang == null){
            break;
        }
    }

    $name = str_random(10);
    return [
        'name' => $name,
        'nativeName' => $name,
        'slug' => $tmpFaker->languageCode,
        'isDefault' => 0,
        'isVisible' => 1,
    ];
});
