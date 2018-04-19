<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\Cache;
use App\Models\Language;

class CategoryDevSeeder extends Seeder
{

    /**
     * Write category titles as "Example {nr}"
     * @var boolean
     */
    public $exampleTitles = false;

    /**
     * Run the database seeds.
     *
     * @param int $categoriesPerPostType
     * @param string $postTypeSlug The slug of post type if we need to generate categories only for a specific post type
     * @return string
     * @throws Exception
     */
    public function run($categoriesPerPostType = 1, $postTypeSlug = null){
        Cache::flush();

        if(!is_numeric($categoriesPerPostType)){
            $categoriesPerPostType = 1;
        }
        if($categoriesPerPostType) {
            $postTypes = \App\Models\PostType::all();
            $countPostTypes = $postTypes->count();

            // Ensure we have enough date to move on
            if (!$countPostTypes) {
                Throw new Exception("No categories created. Please add some post types first!");
            }

            // Create categories only for a specific post type
            if ($postTypeSlug) {
                $postType = $postTypes->where('slug', $postTypeSlug)->first();
                if ($postType) {
                    $this->createCategory($postType->postTypeID, $categoriesPerPostType);
                }
                $output = "Category created successfully";
            } // or for all post types
            else {

                foreach ($postTypes as $postType) {
                    $this->createCategory($postType->postTypeID, $categoriesPerPostType);
                }

                $output = "Categories created successfully (" . ($categoriesPerPostType * $countPostTypes) . ")";
            }

            if ($this->command) {
                $this->command->info($output);
            }

            return $output;
        }
    }

    /**
     * Create a category
     * @param int $postTypeID
     * @param int $categoriesPerPostType
     * @return array
     */
    public function createCategory($postTypeID, $categoriesPerPostType = 1){
        $lastCategory = \App\Models\Category::where('postTypeID', $postTypeID)->limit(1)->orderBy('order', 'DESC')->get();
        if($lastCategory->count()){
            $order = $lastCategory->first()->order;
        }else{
            $order = 1;
        }

        $order++;

        $data = [
            'postTypeID' => $postTypeID,
            'order' => $order,
        ];

        if($this->exampleTitles){
            foreach (Language::all() as $language){
                $title = "Example Category".($lastCategory->count() ? ' '.$order : '');
                $data['title'][$language->slug] = $title;
                $data['slug'][$language->slug] = str_slug($title."-".rand(50,200));
            }
        }

        $createdCategories = factory(\App\Models\Category::class, $categoriesPerPostType)->create($data);
        return $createdCategories;
    }
}
