<?php

return [


    /*
    |
    | What should be shared between uploads?
    |
    */
    'shared' => [
        'from' => base_path('storage'),
        'to' => base_path().'/../../shared',
    ],

    /*
    |
    | Fix Permissions on deploy
    |
    */
    'permissions'=> [
        'apache' => [
            [
                'path' => base_path().'/../../shared',
                'group' => 'deploy',
                'only_directories' => true,
            ],

            [
                'path' => base_path('storage'),
                'group' => 'deploy',
                'only_directories' => true,
            ],

            [
                'path' => base_path('bootstrap/cache'),
                'group' => 'deploy',
                'only_directories' => true,
            ],

            [
                'path' => base_path('public/uploads'),
                'group' => 'deploy',
                'only_directories' => true,
            ]
        ],

        'chmod' => [
            [
                'path' => base_path('storage'),
                'permission' => 775,
                'only_directories' => true,
            ],

            [
                'path' => base_path('bootstrap/cache'),
                'permission' => 775
            ],

            [
                'path' => base_path('public/uploads'),
                'permission' => 775,
                'only_directories' => true,
            ]
        ],
    ],

    /*
    |
    | Copy uploads on deploy
    |
    */
    'uploads' => [
        'from' => base_path('public/uploads/*'),
        'to' => base_path().'/../../shared/public/uploads',
    ],


    /*
    |--------------------------------------------------------------------------
    | Clean directories
    |--------------------------------------------------------------------------
    |
    | It is usually used to empty cache directories
    |
    */
    'clean_directories' => [
        storage_path('framework/cache'),
        storage_path('framework/views'),
        base_path('bootstrap/cache')
    ],

    /*
    |
    | Specify what symlinks should be created after deploy
    |
    */
    'symlinks' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Deploy database
    |--------------------------------------------------------------------------
    |
    | Here you specify where we should look for sql files to be imported when
    | take place
    |
    */

    'database' => [
        'enabled' => true,

        'path' => database_path('deployments')
    ],
];
