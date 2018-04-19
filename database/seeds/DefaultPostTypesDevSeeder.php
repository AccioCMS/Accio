<?php

use Illuminate\Database\Seeder;
use App\Models\PostType;

class DefaultPostTypesDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return string
     */
    public function run()
    {
        $output = '';

        $output .= $this->createPostArticles()." \n";
        $output .= $this->createPostPages();

        if ($this->command) {
            $this->command->info($output);
        }
        return $output;
    }

    /**
     * Crate Post Articles
     * @return string
     */
    public function createPostArticles(){
        // Make is it doesn't exist
        $check = PostType::where('slug','post_articles')->get();

        if($check->count()) {
            $output = "Post Articles already exists!";
        }else{
            // Create post type row
            $createdPostType = factory(PostType::class)->create([
                'name' => 'Articles',
                'slug' => 'post_articles',
                'isVisible' => true,
                'hasCategories' => true,
                'hasTags' => true,
            ]);

            // Create table if it doesn't exist
            PostType::createTable($createdPostType->slug, [], 'mysql', false);

            $output = "Post Articles created successfully!";
        }

        if ($this->command) {
            $this->command->info($output);
        }
        return $output;
    }

    /**
     * Crate Post Pages
     * @return string
     */
    public function createPostPages(){

        // Make is it doesn't exist
        $check = PostType::where('slug','post_pages')->get();
        if($check->count()) {
            $output = "Post Pages already exists!";
        }else {
            $createdPostType = factory(PostType::class)->create([
                'name' => 'Pages',
                'slug' => 'post_pages',
                // 'fields' => [],
                'isVisible' => true,
                'hasCategories' => false,
                'isCategoryRequired' => false,
                'hasTags' => false,
                'isTagRequired' => false,
            ]);

            // Create table if it doesn't exist
            PostType::createTable($createdPostType->slug, [], 'mysql', false);

            $output = "Post Pages created successfully!";
        }

        if($this->command) {
            $this->command->info($output);
        }

        return $output;
    }
}
