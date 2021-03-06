<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Schema;
use App\Models\PostType;

class PostTypeSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @param int $totalPostTypes Number of post types to create
     * @return void
     */
    public function run(int $totalPostTypes = 1)
    {
        if($totalPostTypes) {
            $postTypeNames = [];
            for ($i = 1; $i <= $totalPostTypes; $i++) {

                // Create post type row
                $createdPostType = factory(PostType::class)->create();

                // Create table
                PostType::createTable($createdPostType->slug);
                $postTypeNames[] = $createdPostType->name;
            }
            if(isset($this->command)){
                $this->command->info('Post Types created (' . implode(", ", $postTypeNames) . ')');
            }
        }else{
            if(isset($this->command)){
                $this->command->error("Please give a total number of post type you would like to create!");
            }
        }

        return;
    }

    /**
     * Run the database seeds.
     *
     * @return string
     */
    public function createDefaultPostTypes()
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
              'isFeaturedImageRequired' => true,
              'hasTags' => true,
            ]);

            // Create table if it doesn't exist
            PostType::createTable($createdPostType->slug, [], true, true);

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
              'isFeaturedImageRequired' => false,
              'hasTags' => false,
              'isTagRequired' => false,
            ]);

            // Create table if it doesn't exist
            PostType::createTable($createdPostType->slug, [], false, false, true, 'PagesController');

            $output = "Post Pages created successfully!";
        }

        if($this->command) {
            $this->command->info($output);
        }

        return $output;
    }
}
