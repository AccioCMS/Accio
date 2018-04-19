<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermalinksTableSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $data = [
            [
                'belongsTo' => 'post_articles',
                'name' => 'index',
                'custom_url' => '',
                'default_url' => 'articles',
                'acceptedParameters' => '{postTypeID}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'post_articles',
                'name' => 'single',
                'custom_url' => '',
                'default_url' => '{postSlug}',
                'acceptedParameters' => '{postID}, {postSlug), {date}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'category',
                'name' => 'single',
                'custom_url' => '',
                'default_url' => 'category/details/{categorySlug}',
                'acceptedParameters' => '{categoryID}, {categorySlug}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'category',
                'name' => 'posts',
                'custom_url' => '',
                'default_url' => 'category/{categorySlug}',
                'acceptedParameters' => '{categoryID}, {categorySlug}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'tag',
                'name' => 'single',
                'custom_url' => '',
                'default_url' => 'tag/{tagSlug}',
                'acceptedParameters' => '{tagID}, {tagSlug}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'user',
                'name' => 'single',
                'custom_url' => '',
                'default_url' => 'author/{authorSlug}',
                'acceptedParameters' => '{authorSlug}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'user',
                'name' => 'posts',
                'custom_url' => '',
                'default_url' => 'author/{authorSlug}/{postTypeSlug}',
                'acceptedParameters' => '{authorSlug}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'search',
                'name' => 'results',
                'custom_url' => '',
                'default_url' => 'search/{keyword}',
                'acceptedParameters' => '{keyword}',
            ],
            [
                'belongsTo' => 'base',
                'name' => 'homepage',
                'custom_url' => '',
                'default_url' => '/',
                'acceptedParameters' => '',
            ],
            [
                'belongsTo' => 'post_pages',
                'name' => 'single',
                'custom_url' => '',
                'default_url' => 'pages/{postSlug}',
                'acceptedParameters' => '{postID}, {postSlug), {date}, {postTypeSlug}',
            ],
            [
                'belongsTo' => 'search',
                'name' => 'results.post',
                'custom_url' => '',
                'default_url' => 'search',
                'acceptedParameters' => '',
            ]
        ];
        
        DB::table('permalinks')->insert($data);
    }
}
