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
     * @return void
     * @throws Exception
     */
    public function run(int $totalCategories = 0, string $postTypeSlug = null, bool $allPostTypes = false){
        $postType = null;

        if($totalCategories) {
            $postTypes = \App\Models\PostType::all();
            $countPostTypes = $postTypes->count();

            if($allPostTypes) {
                foreach ($postTypes as $postType) {
                    $this->command->info("Creating categories in post type '".$postType->name."'");
                    $this->createCategory($postType, $totalCategories);
                }
                $this->command->info("Categories created (" . ($totalCategories * $countPostTypes) . ")");
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
                if($this->createCategory($postType, $totalCategories)) {
                    $this->command->info("Categories created (" . $totalCategories . ")");
                }else{
                    $this->command->error("Categories not created! Make sure the post type '".$postTypeSlug."' use categories!");
                }
            }
        }else{
            $this->command->error("Please give a total number of posts you would like to create!");
        }

        return;
    }

    /**
     * Create a category
     *
     * @param object $postType
     * @param int $categoriesPerPostType
     * @return array
     */
    public function createCategory($postType, $categoriesPerPostType = 1){
        $createdCategories = [];
        if($postType->hasTags) {
            $lastCategory = \App\Models\Category::where('postTypeID', $postType->postTypeID)->limit(1)->orderBy('order', 'DESC')->get();
            if ($lastCategory->count()) {
                $order = $lastCategory->first()->order;
            } else {
                $order = 1;
            }

            $order++;

            $data = [
              'postTypeID' => $postType->postTypeID,
              'order' => $order,
            ];

            if ($this->exampleTitles) {
                foreach (Language::all() as $language) {
                    $title = "Example Category" . ($lastCategory->count() ? ' ' . $order : '');
                    $data['title'][$language->slug] = $title;
                    $data['slug'][$language->slug] = str_slug($title . "-" . rand(50, 200));
                }
            }

            $createdCategories = factory(\App\Models\Category::class, $categoriesPerPostType)->create($data);
        }

        return $createdCategories;
    }
}
