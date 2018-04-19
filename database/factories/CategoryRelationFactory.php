<?php

use Faker\Generator as Faker;

$factory->define(App\Models\CategoryRelation::class, function (Faker $faker) {
    return [
        'categoryID' => '',
        'belongsToID' => '',
        'belongsTo' => '',
    ];
});
