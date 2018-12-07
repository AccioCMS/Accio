<?php

use Faker\Generator as Faker;

use Illuminate\Support\Facades\File;
$factory->define(App\Models\Media::class, function (Faker $faker) {

    $datePath = date('Y/m/d');
    $destinationPath = uploadsPath($datePath);
    $fileDirectory = 'public'.explode('public', $destinationPath)[1];
    $fileDirectory = str_replace('\\','/', $fileDirectory);
    $users = \App\Models\User::select('userID')->inRandomOrder()->first();

    $fileFullPathOriginal = base_path($fileDirectory.'/original');
    if(!File::exists($fileFullPathOriginal)){
        if(!File::makeDirectory($fileFullPathOriginal, 0775, true)){
            return "Unable to create directory: ".$fileFullPathOriginal;
        }
    }

    // Upload an image
    $uploadedFileName = $faker->image($fileFullPathOriginal, rand(700, 800), rand(400, 500), null, false);

    if($uploadedFileName instanceof RuntimeException){
        throw new Exception($uploadedFileName->getMessage());
    }

    //handle error
    if(is_array($uploadedFileName)){
        dump($uploadedFileName);
        throw new Exception("ska fajllname");
    }

    // Get file data
    $fullLocalPath = $fileFullPathOriginal.'/'.$uploadedFileName;
    $pathinfo = pathinfo($fullLocalPath);
    list($width, $height) = @getimagesize($fullLocalPath);

    if(!file_exists($fullLocalPath)){
        throw new Exception("File '".$fullLocalPath."' could not be created ");
    }

    $data = [
      'createdByUserID' => ($users ? $users->userID : null),
      'title' => $faker->text(50),
      'description' => $faker->text(100),
      'credit' => $faker->firstName.' '.$faker->lastName,
      'type' => 'image',
      'extension' => $pathinfo['extension'],
      'url' => $fileDirectory.'/original/'.$uploadedFileName,
      'filename' => $pathinfo['filename'].'.'.$pathinfo['extension'],
      'fileDirectory' => $fileDirectory,
      'fileSize' => bcdiv(filesize($fullLocalPath), 1048576, 2),
      'dimensions' => $width.'x'.$height,
    ];

    return $data;
});
