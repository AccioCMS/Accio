<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
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
    public function run(int $totalTags = 1, string $postTypeSlug = null, bool $allPostTypes = false)
    {
        $output = '';
        $postType = null;

        if ($totalTags) {
            $postTypes = \App\Models\PostType::all();
            $countPostTypes = $postTypes->count();

            if ($allPostTypes) {
                foreach ($postTypes as $postType) {
                    $this->writeOutput("Creating tags in post type '".$postType->name."'");
                    $this->createTag($postType, $totalTags);
                }
                $this->writeOutput("Tags created (" . ($totalTags * $countPostTypes) . ")");
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
                if($this->createTag($postType, $totalTags)) {
                    $this->writeOutput("Tags created (" . $totalTags . ")");
                }else{
                    $this->command->error("Tags not created! Make sure the post type '".$postTypeSlug."' use categories!");
                }
            }
        }else{
            $this->command->error("Please give a total number of tags you would like to create!");
        }

        return $output;
    }

    /**
     * @param object $postType
     * @param int $tagsPerPostType
     * @return array
     */
    public function createTag($postType, $tagsPerPostType = 1){
        $tags = [];
        if($postType->hasTags) {
            $tags =  factory(\App\Models\Tag::class, $tagsPerPostType)->create([
              'postTypeID' => $postType->postTypeID,
            ]);
        }
        return $tags;
    }

    /**
     * Write output message
     *
     * @param string $message
     */
    private function writeOutput(string $message){
        if(isset($this->command)){
            $this->command->info($message);
        }
    }
}
