
<?php

use Faker\Generator as Faker;
use \App\Models\Language;

$autoIncrement = autoIncrementMenuLink();

$factory->define(\App\Models\MenuLink::class, function (Faker $faker) use($autoIncrement) {
    $autoIncrement->next();

    $menuList = \App\Models\Menu::all();

    if(!$menuList){
        throw new Exception('Please add a menu before trying to add a Menu Link!');
    }

    $data =  [
        'menuID' => $menuList->random(1)->first()->menuID,
        'parent' => 0,
        'belongsTo' => '',
        'belongsToID' => '',
        'order' => $autoIncrement->current(),
    ];

    foreach(Language::all() as $language){
        $data['label'][$language->slug] = $faker->realText(10);
    }

    return $data;
});

function autoIncrementMenuLink()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}