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
     * @param int $totalCategories
     * @param string $postTypeSlug The slug of post type if we need to generate categories only for a specific post type
     * @param boolean $allPostTypes True, if categories should be generate for all available posts types
     * @return string
     * @throws Exception
     */
    public function run(int $totalCategories = 0, string $postTypeSlug = null, bool $allPostTypes = false){
        $output = '';
        $postType = null;

        if($totalCategories) {
            $postTypes = \App\Models\PostType::all();
            $countPostTypes = $postTypes->count();

            if($allPostTypes) {
                foreach ($postTypes as $postType) {
                    $this->createCategory($postType->postTypeID, $totalCategories);
                }
                $output = "Categories created successfully (" . ($totalCategories * $countPostTypes) . ")";
            }else { // or for all post types

                // Default post type
                if(!$postTypeSlug){
                    $postTypeSlug = config('project.default_post_type');
                }

                $postType = getPostType($postTypeSlug);
                if (!$postType) {
                    Throw new Exception('Post type ' . $postTypeSlug . ' not found!');
                }

                // Create categories only for a specific post type
                $this->createCategory($postType->postTypeID, $totalCategories);
                $output = "Categories created successfully (".$totalCategories.")";
            }

            if ($this->command) {
                $this->command->info($output);
            }
        }

        return $output;
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
