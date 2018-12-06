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
     * @param boolean $allPostTypes
     *
     * @return string
     * @throws Exception
     */
    public function run(
      int $totalPosts = 0,
      int $postsPerCategory = 0,
      string $postType = '',
      int $totalMedia = 0,
      int $totalTags = 0,
      $category = 0,
      $allPostTypes = false
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
        $totalInserted = 0;

        if($this->validateRequirements()) {

            if ($this->postsPerCategory || $this->totalPosts) {
                $this->generateMedia();
                $this->generateTags();

                // generate posts for a specific category or post type
                if($category || ($this->totalPosts && !$this->postsPerCategory)) {

                    // create posts in all post types, without a category
                    if($allPostTypes){
                        $postTypes = \App\Models\PostType::all();
                        foreach ($postTypes as $postType) {
                            $this->writeOutput('Creating posts in post type: '.$postType->name, 'comment');
                            for ($i = 1; $i <= $this->totalPosts; $i++) {
                                $totalInserted++;
                                $this->createPost($postType, $this->mediaList, null, $this->tagsList);
                            }
                        }
                    }else{
                        $categoryData = null;

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

                        $this->writeOutput('Creating posts in post type: '.$this->postType->name, 'comment');
                        for ($i = 1; $i <= $this->totalPosts; $i++) {
                            $totalInserted++;
                            $this->createPost($this->postType, $this->mediaList, $categoryData, $this->tagsList);
                        }
                    }
                }
                else { // generate posts for each of post types
                    if($allPostTypes){
                        $postTypes = \App\Models\PostType::all();
                        foreach ($postTypes as $postType) {
                            $totalInserted += $this->addPostInCategories($postType);
                        }
                    }else {
                        $totalInserted = $this->addPostInCategories($this->postType);
                    }
                }

                if ($totalInserted) {
                    $this->writeOutput( "Posts created (" . $totalInserted . "). ",'info');
                }
                else {
                    $this->writeOutput( "No posts created!",'error');
                }
            }else{
                $this->writeOutput("Please give a total number of posts you would like to create!",'error');
            }
        }

        return;
    }

    /**
     * Add posts for each of category of a given post type.
     *
     * @param object $postType
     * @return int
     */
    private function addPostInCategories($postType){
        $totalInserted = 0;
        $categories = \App\Models\Category::all()->where('postTypeID', $postType->postTypeID);;

        if ($postType->hasCategories && $categories) {
            $this->writeOutput("Creating posts in post type '".$postType->name."'",'comment');

            foreach ($categories as $category) {
                $this->writeOutput(" -- Creating ".$this->postsPerCategory." posts in category '".$category->title."'",'comment');

                for ($i = 1; $i <= $this->postsPerCategory; $i++) {
                    $totalInserted++;
                    $this->createPost($postType, $this->mediaList, $category, $this->tagsList);
                }
            }
        }else{
            $this->writeOutput('Post type "'.$postType->name.'" does not have any category!','comment');
        }

        return $totalInserted;
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
            $mediaDevSeeder->setCommand($this->command)->run(($this->totalMedia - $this->mediaList->count()));
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
                $mediaDevSeeder->setCommand($this->command)->run(($this->totalTags - $this->tagsList->count()));
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
        if($postType->hasCategories && $category){
            $createdCategory = $this->createCategoryRelation($postType, $post, $category);
        }

        $createdTags = [];
        if($postType->hasTags && $tags){
            if($tags->count() > 5){
                $tags = $tags->take(rand(2,6));
            }
            foreach($tags as $tag){
                $createdTags[] = $this->createTagRelation($postType, $post, $tag);
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
     * Create Category relation.
     *
     * @param object$postType
     * @param object $post
     * @param object $category
     */
    public function createCategoryRelation($postType, $post, $category){
        $model = new \App\Models\CategoryRelation();
        $model->setTable($postType->slug.'_categories');
        $model->categoryID = $category->categoryID;
        $model->postID = $post->postID;
        $model->save();

    }

    /**
     * Create Tag relation.
     *
     * @param object $postType
     * @param object $post
     * @param object $tag
     */
    public function createTagRelation($postType, $post, $tag){
        $model = (new \App\Models\TagRelation());
        $model->setTable($postType->slug.'_tags');
        $model->tagID = $tag->tagID;
        $model->postID = $post->postID;
        $model->save();
    }

    /**
     * Create media relations for each image|file field.
     *
     * @param object $postType
     * @param object $post
     * @param object $mediaList
     */
    public function createMediaRelations($postType, $post, $mediaList){
        foreach ($postType->fields as $field) {
            switch ($field->type->inputType) {
                case 'image':
                case 'file':
                    $mediaID = $mediaList->random()->mediaID;

                    $model = (new \App\Models\MediaRelation());
                    $model->setTable($postType->slug.'_media');
                    $model->mediaID =$mediaID;
                    $model->postID = $post->postID;
                    $model->field = $field->slug;
                    $model->language = App::getLocale();
                    $model->save();

                    break;
            }
        }
    }

    /**
     * Write output message
     *
     * @param string $message
     */
    private function writeOutput(string $message, string $type = "info"){
        if(isset($this->command)){
            if($type == "info"){
                $this->command->info($message);
            }elseif ($type == "comment"){
                $this->command->comment($message);
            }elseif($type == "error"){
                $this->command->error($message);
            }
        }
    }
}
