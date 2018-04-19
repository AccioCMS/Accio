<?php

use Faker\Generator as Faker;
use \App\Models\Language;

$factory->define(App\Models\MediaRelation::class, function (Faker $faker) {
    $languages = Language::all();

    $data =  [
        'mediaID' => '',
        'belongsToID' => '',
        'belongsTo' => '',
        'field' => '',
    ];

    foreach($languages as $language){
        $data['language'][$language->slug] = true;
    }

    $data['language'] = json_encode($data['language']);

    return $data;
});
