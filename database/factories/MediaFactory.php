<?php

use Faker\Generator as Faker;

use Illuminate\Support\Facades\File;
$factory->define(App\Models\Media::class, function (Faker $faker) {

    $datePath = date('Y/m/d');
    $destinationPath = uploadsPath($datePath);
    $fileDirectory = 'public'.explode('public', $destinationPath)[1];
    $fileDirectory = str_replace('\\','/', $fileDirectory);
    $users = \App\Models\User::all();

    $fileFullPathOriginal = base_path($fileDirectory.'/original');
    if(!File::exists($fileFullPathOriginal)){
        if(!File::makeDirectory($fileFullPathOriginal, 0775, true)){
            return "Unable to create directory: ".$fileFullPathOriginal;
        }
    }

    // Upload an image
    $fileName = $faker->image($fileFullPathOriginal, rand(700, 800), rand(400, 500), null, false);

    if($fileName instanceof RuntimeException){
        throw new Exception($fileName->getMessage());
    }

    //handle error
    if(is_array($fileName)){
        throw new Exception();
    }
    // Get file data
    $fullPath = $fileFullPathOriginal.'/'.$fileName;
    $pathinfo = pathinfo($fullPath);
    list($width, $height) = @getimagesize($fullPath);

    return [
        'title' => $faker->text(50),
        'description' => $faker->text(100),
        'credit' => $faker->firstName.' '.$faker->lastName,
        'type' => 'image',
        'extension' => $pathinfo['extension'],
        'url' => $fileDirectory.'/original/'.$fileName,
        'filename' => $pathinfo['filename'].'.'.$pathinfo['extension'],
        'fileDirectory' => $fileDirectory,
        'fileSize' => bcdiv(filesize($fullPath), 1048576, 2),
        'dimensions' => $width.'x'.$height,
        'createdByUserID' => $users->random()->userID
    ];
});
