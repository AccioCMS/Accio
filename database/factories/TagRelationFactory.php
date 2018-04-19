<?php

use Faker\Generator as Faker;
use \Illuminate\Support\Facades\App;

$factory->define(\App\Models\TagRelation::class, function (Faker $faker) {
    return [
        'tagID' => '',
        'belongsToID' => '',
        'belongsTo' => '',
        'language' => App::getLocale(),
    ];
});
