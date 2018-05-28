<?php

use Illuminate\Database\Seeder;
use \Accio\App\Commands\MakeDummy;
use \App\Models\Category;

class PostDevSeeder extends Seeder
{

    /**
     * @var object
     */
    private $mediaList;

    /**
     * @var object
     */
    private $postType;

    /**
     * @var object
     */
    private $tagsList;

    /**
     * @var int
     */
    private $postsPerCategory;

    /**
     * @var int
     */
    private $totalPosts;

    /**
     * @var int
     */
    private $totalMedia;

    /**
     * @var int
     */
    private $totalTags;

    /**
     * @param int $totalPosts
     * @param int $postsPerCategory
     * @param string $postType
     * @param int $totalMedia
     * @param int $totalTags
     * @param int|string $category
     * @return string
     * @throws Exception
     */
    public function run(
      int $totalPosts = 0,
      int $postsPerCategory = 0,
      string $postType = '',
      int $totalMedia = 0,
      int $totalTags = 0,
      $category = 0
    )
    {

        // Default post type
        if(!$postType){
            $postType = config('project.default_post_type');
        }
        $this->postType = getPostType($postType);
        $this->totalPosts = $totalPosts;
        $this->totalMedia = $totalMedia;
        $this->totalTags = $totalTags;
        $this->postsPerCategory = $postsPerCategory;
        $output = '';

        if($this->validateRequirements()) {

            if ($this->postsPerCategory || $this->totalPosts) {
                $postsCreated = 0;
                $categories = [];
                $categoryData = null;
                $this->generateMedia();
                $this->generateTags();

                // generate posts for a specific category or post type
                if($category || $this->totalPosts) {

                    // validate category
                    if($category){
                        if(is_numeric($category)){
                            $categoryData = Category::find($category);
                        }else{
                            $categoryData = Category::findBySlug($category);
                        }

                        if(!$categoryData){
                            throw new Exception('Category "'.$category.'" not found!');
                        }
                    }else{
                        $categoryData = null;
                    }


                    for ($i = 1; $i <= $this->totalPosts; $i++) {
                        $postsCreated++;
                        $this->createPost($this->postType, $this->mediaList, $categoryData, $this->tagsList);
                    }
                }
                else { // generate posts for each of post types
                    // get categories of this post type
                    if ($this->postType->hasCategories) {
                        $categories = \App\Models\Category::all()->where('postTypeID', $this->postType->postTypeID);;
                        if (!$categories) {
                            throw new Exception('No categories found for post type: ' . $this->postType->slug);
                        }
                    }

                    foreach ($categories as $category) {
                        for ($i = 1; $i <= $this->postsPerCategory; $i++) {
                            $postsCreated++;
                            $this->createPost($this->postType, $this->mediaList, $category, $this->tagsList);
                        }
                    }
                }

                $output = "Posts created successfully (" . $postsCreated . "). ";

            }

            if ($this->command) {
                $this->command->info($output);
            }
        }

        return $output;
    }

    /**
     * Validate post creation
     * @throws Exception
     */
    private function validateRequirements(){
        // Validate post type
        if(!$this->postType){
            throw new Exception('Post type not found');
        }

        if(!$this->totalPosts && !$this->postsPerCategory){
            throw new Exception('You must specify a total number of posts to be created!');
        }
        return true;
    }

    /**
     * Generate media dummy if we don't have any
     * @return $this
     */
    private function generateMedia(){
        $this->mediaList = \App\Models\Media::all();
        if(!$this->mediaList->count() || $this->mediaList->count() < $this->totalMedia){
            $mediaDevSeeder = new MediaDevSeeder();
            $mediaDevSeeder->run(($this->totalMedia - $this->mediaList->count()));
        }
        return $this;
    }

    /**
     * Generate tags to append into posts
     *
     * @return $this
     * @throws Exception
     */
    private function generateTags(){
        if ($this->postType->hasTags) {
            $this->tagsList  = \App\Models\Tag::all()->where('postTypeID', $this->postType->postTypeID);

            if(!$this->tagsList->count() || $this->tagsList->count() < $this->totalTags){
                $mediaDevSeeder = new TagDevSeeder();
                $mediaDevSeeder->run(($this->totalTags - $this->tagsList->count()));
            }
        }
        return $this;
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
        foreach ($postType->fields as $field) {
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
