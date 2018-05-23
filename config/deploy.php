<?php

return [

    /*
    |
    | Fix Permissions on deploy
    |
    */
    'permissions'=> [
        'apache' => [
//            [
//                'path' => base_path().'/../../shared',
//                'group' => 'deploy',
//                'only_directories' => true,
//            ],
        ],

        'chmod' => [
//            [
//                'path' => base_path('storage'),
//                'permission' => 775,
//                'only_directories' => true,
//            ]
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
    |
    |--------------------------------------------------------------------------
    | Symlink
    |--------------------------------------------------------------------------
    | Symlinks that should be created after deploy
    |
    */
    'symlinks' => [

    ],

    /*
    |
    |--------------------------------------------------------------------------
    | Cron Jobs
    |--------------------------------------------------------------------------
    | Cron jobs that should be created after a deploy is released
    |
    */
    'cron' => [
        '* * * * * php '.base_path().'/artisan schedule:run >> /dev/null 2>&1'
    ],

    /*
    |
    |--------------------------------------------------------------------------
    | Custom Commands
    |--------------------------------------------------------------------------
    | List of commands that should be run on deploy
    |
    */
    'commands' => [
        /*
         |
         |--------------------------------------------------------------------------
         | Create New Release
         |--------------------------------------------------------------------------
         | Commands that should be run when a release is created
         |
         */
        'create_new_release' => [
            'before' => [],
            'after' => []
        ],

        /*
         |
         |--------------------------------------------------------------------------
         | Install Composer Dependencies
         |--------------------------------------------------------------------------
         | Commands that should be run when installing composer dependencies
         |
         */
        'composer' => [
            'before' => [],
            'after' => []
        ],

        /*
        |
        |--------------------------------------------------------------------------
        | Activate New Release
        |--------------------------------------------------------------------------
        | Commands that should be when a release is activated
        |
        */
        'activate_new_release' => [
            'before' => [
                'deploy:permissions',
                'deploy:copy_uploads',
                'php artisan cache:clear',
                'deploy:env',
                'deploy:db',
                'deploy:cron',
            ],
            'after' => []
        ],

        /*
         |
         |--------------------------------------------------------------------------
         | Purge Old Releases
         |--------------------------------------------------------------------------
         | Commands that should be run when old release is purged
         |
         */
        'purge_old_releases' => [
            'before' => [],
            'after' => []
        ],
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
