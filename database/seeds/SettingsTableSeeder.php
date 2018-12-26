<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            [
                'settingsKey' => 'siteTitle',
                'value' => 'My site',
            ],
            [
                'settingsKey' => '',
                'value' => '',
            ],
            [
                'settingsKey' => '',
                'value' => '',
            ],
            [
                'settingsKey' => '',
                'value' => '',
            ]

        ];
    }

}
