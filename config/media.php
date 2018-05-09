<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Image Driver
    |--------------------------------------------------------------------------
    |
    | Intervention Image supports "GD Library" and "Imagick" to process images
    | internally. You may choose one of them according to your PHP
    | configuration. By default PHP's "GD Library" implementation is used.
    |
    | Supported: "gd", "imagick"
    |
    */

    'driver' => 'gd',

    /*
    |
    | File extensions that are allowed to be uploaded from admin panel
    |
    */
    'extensions' => array('jpg','png','jpeg','pdf','txt'),

    /*
    |
    | Image extensions that are allowed to be uploaded
    |
    */
    'image_extensions' => array('jpg','png','jpeg'),

    /*
    |
    | Documents extensions that are allowed to be uploaded.
    |
    */
    'document_extensions' => array('pdf','doc','docs','xls','xlsx','csv','txt'),

    /*
    |
    |  Audio extensions that are allowed to be uploaded.
    |
    */
    'audio_extensions' => array('mp3','ogg'),

    /*
    |
    | Video extensions that are allowed to be uploaded.
    |
    */
    'video_extensions' => array('mp4','flv','mov'),

    /*
    |
    | Document icon path that should be shown in admin interface
    |
    */
    'document_icon_url' => '/images/document.png',

    /*
    |
    | Video icon path that should be shown in admin interface
    |
    */
    'video_icon_url' => '/images/video.png',

    /*
    |
    |  Audio icon path that should be shown in admin interface
    |
    */
    'audio_icon_url' => '/images/audio.png',

    /*
    |
    |  Optimize original image
    |
    */
    'optimize_original_image' => true,

    /*
    |
    | Default thumb sizes of the app
    | the second level represent the model name where the thumb is applicable
    //@TODO should be defined in each model respectively
    //@TODO handle thumbs that have only a fixed width,
    //@TODO handle thumbs that have only a fixed height
    |
    */
    'default_thumb_size' => [
      'default' => [
        [200,200]
      ],
      'users' => [
        [100,100],
      ],
    ]
);
