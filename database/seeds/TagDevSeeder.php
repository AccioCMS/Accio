<?php

use Illuminate\Database\Seeder;

class TagDevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param int $totalTags
     * @param string $postTypeSlug The slug of post type if we need to generate tags only for a specific post type
     * @param boolean $allPostTypes True, if tags should be generated for all of available posts types
     *
     * @return string
     * @throws Exception
     */
    public function run(int $totalTags = 0, string $postTypeSlug = null, bool $allPostTypes = false)
    {
        $output = '';
        $postType = null;

        if ($totalTags) {
            $postTypes = \App\Models\PostType::all();
            $countPostTypes = $postTypes->count();

            if ($allPostTypes) {
                foreach ($postTypes as $postType) {
                    $this->createTag($postType->postTypeID, $totalTags);
                }
                $output = "Tags created successfully (" . ($totalTags * $countPostTypes) . ")";
            } else { // or for all post types

                // Default post type
                if (!$postTypeSlug) {
                    $postTypeSlug = config('project.default_post_type');
                }

                $postType = getPostType($postTypeSlug);
                if (!$postType) {
                    Throw new Exception('Post type ' . $postTypeSlug . ' not found!');
                }

                // Create tags only for a specific post type
                $this->createTag($postType->postTypeID, $totalTags);

                $output = "Tags created successfully (" . $totalTags . ")";
            }

            if ($this->command) {
                $this->command->info($output);
            }
        }

        return $output;
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
