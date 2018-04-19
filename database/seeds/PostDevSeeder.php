<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class PostDevSeeder extends Seeder
{

    /**
     * Media to create if they do not exist
     * @var int $totalMedia
     */
    public $totalMedia = 50;

    /**
     * Run the database seeds.
     *
     * @param int $postsPerCategory
     * @return string
     * @throws Exception
     */
    public function run(int $postsPerCategory = 0){
        if($postsPerCategory){
            $totalPosts = 0;
            $message = [];
            $postTypes = \App\Models\PostType::all();
            $mediaList = \App\Models\Media::all();
            $categoriesList = \App\Models\Category::all();
            $tagList = \App\Models\Tag::all();

            // Ensure we have enough date to move on
            if (!$postTypes->count()) {
                throw new Exception("No posts created. Please add some post types first!");
            }

            // Auto generate media if they do not exist
            if(!$mediaList->count()){
                $mediaDevSeeder = new MediaDevSeeder();
                $mediaDevSeeder->run($this->totalMedia);
            }

            foreach($postTypes as $postType){
                // Handle tags
                $tags = null;
                if ($postType->hasTags) {
                    $tags = $tagList->where('postTypeID', $postType->postTypeID);
                    if (!$tags->count()) {
                        if ($this->command) {
                            $this->command->comment('No tags found!');
                        }
                    }
                }

                // Handle Categories
                $categories = null;
                if ($postType->hasCategories) {
                    $categories = $categoriesList->where('postTypeID', $postType->postTypeID);
                    if (!$categories->count()) {
                        if ($this->command) {
                            $this->command->comment('No categories found!');
                        }
                    }
                }

                $createdPosts = 0;
                // Ad post for each category
                if($categories){
                    foreach ($categories as $category) {
                        for ($i = 1; $i <= $postsPerCategory; $i++) {
                            $createdPosts++;
                            $totalPosts++;
                            $this->createPost($postType, $mediaList, $category, $tags);
                        }
                    }

                    // Append command message
                    $message[] = $postType->name . ': ' . $postsPerCategory . ' per category (' . $createdPosts . ')';
                }

                // Create posts without category
                else{
                    for ($i = 1; $i <= $postsPerCategory; $i++) {
                        $totalPosts++;
                        $this->createPost($postType, $mediaList, null, $tags);
                    }

                    // Append command message
                    $message[] = $postType->name . ': (' . $postsPerCategory . ')';
                }
            }

            $output = "Posts created successfully (" . $totalPosts . "). " . implode(', ', $message);

            if ($this->command) {
                $this->command->info($output);
            }

            return $output;
        }
    }

    /**
     * Crate a post
     *
     * @param object $postType
     * @param object $mediaList List of media to randomly choose from
     * @param object $category
     * @param object $tags
     * @param array $data
     * @return array
     */
    public function createPost($postType, $mediaList = null, $category = null, $tags = null, $data = []){
        // Change post table
        \App\Models\Post::$useTmpTable = true;

        (new \App\Models\Post())->setTable($postType->slug);

        $post = factory(\App\Models\Post::class)->create($data);

        $createdCategory = null;
        if($category){
            $createdCategory = $this->createCategoryRelation($postType, $post, $category);
        }

        $createdTags = [];
        if($tags){
            foreach($tags as $tag){
                $createdTags[] = $this->createTagRelation($postType->slug, $post->postID, $tag->tagID);
            }
        }

        $createdMedia = null;
        if($mediaList){
            $createdMedia = $this->createMediaRelations($postType, $post, $mediaList);
        }

        return [
            'post' => $post,
            'category' => $createdCategory,
            'tag' => $createdTags,
            'media' => $createdMedia,
        ];
    }

    /**
     * Create Category relation
     *
     * @param object $category
     * @param object $postType
     * @param object $post
     * @return object Created category relaitons
     */
    public function createCategoryRelation($postType, $post, $category){
        return factory(App\Models\CategoryRelation::class)->create([
            'categoryID' => $category->categoryID,
            'belongsToID' => $post->postID,
            'belongsTo' => $postType->slug
        ]);
    }

    /**
     * Create Tag relation
     *
     * @param int $tagID
     * @param int $postID
     * @param string $postTypeSlug
     * @return object Created category relaitons
     */
    public function createTagRelation($postTypeSlug, $postID, $tagID){
        return factory(App\Models\TagRelation::class)->create([
            'tagID' => $tagID,
            'belongsToID' => $postID,
            'belongsTo' => $postTypeSlug
        ]);
    }

    /**
     * Create media relations for each image|file field
     *
     * @param object $postType
     * @param object $post
     * @param object $mediaList
     * @return array Created media relations
     */
    public function createMediaRelations($postType, $post, $mediaList){
        $createdCategories = [];
        foreach (json_decode($postType->fields) as $field) {
            switch ($field->type->inputType) {
                case 'image':
                case 'file':
                    $mediaID = $mediaList->random()->mediaID;
                    $createdCategories[] = factory(App\Models\MediaRelation::class)->create([
                        'mediaID' => $mediaID,
                        'belongsToID' => $post->postID,
                        'belongsTo' => $postType->slug,
                        'field' => $field->slug,
                    ]);
                    break;
            }
        }
        return $createdCategories;
    }
}
