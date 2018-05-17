<?php

use Faker\Generator as Faker;
use \App\Models\Language;
$factory->define(App\Models\Post::class, function (Faker $faker) {
    // Users
    $users = \App\Models\User::all();
    $languages = Language::all();

    // Create featured image
    $featuredImage = factory(App\Models\Media::class)->create()->makeThumb(200, 200);


    // Default fields
    $data = [
        'createdByUserID' => $users->random()->userID,
        'featuredImageID' => $featuredImage->mediaID,
        'featuredVideoID' => 0,
        'published_at' => $faker->dateTimeBetween(),
        'customFields' => [],
    ];


    // Translatable default fields
    foreach($languages as $language){
        // Title
        $data['title'][$language->slug] = $faker->text(55);

        // Paragraphs
        $content = '<p>'.implode('</p><p>', $faker->paragraphs(2)).'</p>';

        $content .= '<p>'.$faker->sentence(rand(10,15)).' <a href="javascript:;">'.$faker->sentence(rand(2,4)).'</a> '.$faker->sentence(rand(15,25)).'</p>';

        // UL
        $content .= '<ul>';
        for($i = 0; $i<=rand(3,5); $i++){
            $content .= '<li> '.$faker->text(15).' </li>';
        }
        $content .= '</ul>';

        // Paragraphs
        $content .= '<p>'.implode('</p><p>', $faker->paragraphs(1)).'</p>';

        // Image
        $content .= "<figure>";
        $content .= "<img alt='".$featuredImage->title."' src='".base_path($featuredImage->url)."' />";
        $content .= "<figcaption>".$featuredImage->description." <cite>© ".$featuredImage->credit."</cite></figcaption>";
        $content .= "</figure>";

        // Paragraphs
        $content .= '<p>'.implode('</p><p>', $faker->paragraphs(1)).'</p>';

        $content .= '<p>'.$faker->sentence(rand(10,15)).' <a href="javascript:;">'.$faker->sentence(rand(2,4)).'</a> '.$faker->sentence(rand(15,25)).'</p>';

        // OL
        $content .= '<ol>';
        for($i = 0; $i<=rand(3,5); $i++){
            $content .= '<li> '.$faker->text(15).' </li>';
        }
        $content .= '</ol>';
        $content .= '<p>'.implode('</p><p>', $faker->paragraphs(2)).'</p>';
        $data['content'][$language->slug] = $content;

        // Visibility
        $data['status'][$language->slug] = 'published';

        // Slug
        $data['slug'][$language->slug] = $faker->slug();

    }

    // Post Type Fields
    $postClass = new \App\Models\Post();
    $postType = \App\Models\PostType::where('slug',$postClass->getTable())->first();

    if($postType->fields){
        foreach(json_decode($postType->fields) as $field){
            switch ($field->type->inputType){
                case 'text';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->text;
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->text;
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'email';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->email;
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->email;
                    }
                    $data[$field->slug] = $value;
                    break;

                case 'textarea';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->paragraph();
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->paragraph();
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'editor';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = '<p>'.implode('</p><p>', $faker->paragraphs(3)).'</p>';
                        }
                        $value = json_encode($value);
                    }else{
                        $value = '<p>'.implode('</p><p>', $faker->paragraphs(3)).'</p>';
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'number';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->numberBetween(1,50);
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->numberBetween(1,50);
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'image';
                    break;

                case 'file';
                    break;

                case 'date';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->dateTimeBetween('-30 days')->format('Y-m-d H:i:s');
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->dateTimeBetween('-30 days')->format('Y-m-d H:i:s');
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'boolean';
                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $value[$language->slug] = $faker->boolean;
                        }
                        $value = json_encode($value);
                    }else{
                        $value = $faker->boolean;
                    }

                    $data[$field->slug] = $value;
                    break;

                case 'checkbox';
                case 'radio';
                case 'dropdown';
                    $options = explode(',',$field->multioptionValues);

                    if($field->translatable){
                        $value = [];
                        foreach($languages as $language){
                            $rand = explode(':',$options[array_rand($options,1)]);
                            $value[$language->slug] = trim($rand[0]);
                        }
                        $value = json_encode($value);
                    }else{
                        $rand = explode(':',$options[array_rand($options,1)]);
                        $value = trim($rand[0]);
                    }

                    $data[$field->slug] = $value;
                break;

                case 'db';
                    break;
            }
        }
    }

    return $data;
});
