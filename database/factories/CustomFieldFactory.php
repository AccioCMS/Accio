<?php

use Faker\Generator as Faker;
use \App\Models\Language;

$autoIncrement = autoIncrement();

$factory->define(\App\Models\CustomField::class, function (Faker $faker) use($autoIncrement) {
    $autoIncrement->next();

    $data =  [
        'customFieldGroupID' => \Manaferra\App\Models\CustomFieldGroupModel::inRandomOrder()->first()->customFieldGroupID,
        'parentID' => 0,
        'slug' => str_replace('-', '_', $faker->slug(1)),
        'type' => $faker->randomElement(['text', 'number', 'checkbox', 'radio', 'dropdown']),
        'note' => $faker->text(30),
        'order' => $autoIncrement->current(),
        'isRequired' => $faker->randomElement([true, false]),
        'isTranslatable' => $faker->randomElement([true, false]),
        'isActive' => true,
        'isMultiple' => false,
        'wrapperStyle' => [
            'id' => '',
            'class' => '',
            'width' => '',
        ],
        'fieldStyle' => [
            'id' => '',
            'class' => '',
            'width' => '',
        ],
        'layout' => 'row',
        'conditions' => null,
    ];

    foreach(Language::all() as $language){
        $data['label'][$language->slug] = $faker->realText(10);
        $data['placeholder'][$language->slug] = $faker->realText(10);
    }

    // Fields based on type
    switch ($data['type']){
        case 'text';
            $data['defaultValue'] = $faker->randomElement([$faker->realText(10), '']);
            break;

        case 'number';
            $data['defaultValue'] = $faker->randomElement([$faker->numberBetween(10,100), '']);
            break;

        case 'checkbox':
        case 'radio':
        case 'dropdown':
            $options  = "1:".$faker->realText(10).",";
            $options .= "2:".$faker->realText(10).",";
            $options .= "2:".$faker->realText(10).",";
            $options .= "4:".$faker->realText(10)."";

            $data['optionsValues'] = $options;
            $data['isMultiple'] = $faker->randomElement([true, false]);
        break;
    }
    return $data;
});

function autoIncrement()
{
    for ($i = 0; $i < 1000; $i++) {
        yield $i;
    }
}