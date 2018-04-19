<?php

use Illuminate\Database\Seeder;

class TagDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $tagsPerPostType
     * @param string $postTypeSlug The slug of post type if we need to generate tags only for a specific post type
     * @return string
     * @throws Exception
     */
    public function run($tagsPerPostType = null, $postTypeSlug = null)
    {
        if(!is_numeric($tagsPerPostType)){
            $tagsPerPostType = 5;
        }

        if($tagsPerPostType) {
            $postTypes = \App\Models\PostType::all();

            // Ensure we have enough date to move on
            if (!$postTypes->count()) {
                Throw new Exception("No tags created. Please add some post types first!");
            }

            // Create tags only for a specific post type
            if ($postTypeSlug) {
                $postType = $postTypes->where('slug', $postTypeSlug)->first();
                if ($postType) {
                    $this->createTag($postType->postTypeID, $tagsPerPostType);
                    $output = "Tag created successfully";
                }
            } // or for all post types
            else {
                foreach ($postTypes as $postType) {
                    $this->createTag($postType->postTypeID, $tagsPerPostType);
                }
                $output = "Tags created successfully (" . ($tagsPerPostType * $postTypes->count()) . ") " . $tagsPerPostType . ' per post type!';
            }


            if(!isset($output)) {
                if ($this->command) {
                    $this->command->info($output);
                }

                return $output;
            }
        }
    }

    /**
     * @param int $postTypeID
     * @param int $tagsPerPostType
     * @return mixed
     */
    public function createTag($postTypeID, $tagsPerPostType = 1){
        return factory(\App\Models\Tag::class, $tagsPerPostType)->create([
            'postTypeID' => $postTypeID,
        ]);
    }
}
