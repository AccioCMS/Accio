<?php

namespace Tests\Browser;

use App\Models\CategoryRelation;
use App\Models\Language;
use App\Models\Post;
use App\Models\PostType;
use App\Models\TagRelation;
use App\Models\Task;
use Faker\Factory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Accio\App\Services\Archive;
use Tests\DuskTestCase;

class ArchiveTest extends DuskTestCase{
    private $DB;
    private $DBArchive;
    private $allPostTypes;

    /**
     * @group archive
     * @group moveAllPostsToArchive
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testMoveAllPostsToArchive(){
        $pass = true; // if test passes
        $archive = new Archive(false);

        $this->setParams($archive);

        // truncate tables
        foreach($this->allPostTypes as $postType){
            $this->DBArchive->table($postType->slug)->truncate();
        }

        $archive->countAndEstimateNumberOfPost();

        try{
            $archive->moveAllPostsToArchive();
        }catch (\Exception $e){
            echo $e->getMessage();
        }

        // Check if all data are correctly inserted
        foreach($this->allPostTypes as $postType){
            // check if the data are correct (count the rows in the two tables)
            $pass = $this->countTableBetweenConnection($postType->slug);
        }

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group moveAllCategoriesToArchive
     *
     * @throws \Exception
     */
    public function testMoveAllCategoriesToArchive(){
        $archive = new Archive(false);
        $this->setParams($archive);

        $this->DBArchive->table("categories_relations")->truncate();

        $archive->countAndEstimateNumberOfPost();
        try{
            $archive->moveAllCategoriesToArchive();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        // check if the data are correct (count the rows in the two tables)
        $pass = $this->countTableBetweenConnection("categories_relations");

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group moveAllTagsToArchive
     *
     * @throws \Exception
     */
    public function testMoveAllTagsToArchive(){
        $archive = new Archive(false);
        $this->setParams($archive);

        $this->DBArchive->table("tags_relations")->truncate();

        $archive->countAndEstimateNumberOfPost();
        try{
            $archive->moveAllTagsToArchive();
        }catch(\Exception $e){
            echo $e->getMessage();
        }
        // check if the data are correct (count the rows in the two tables)
        $pass = $this->countTableBetweenConnection("tags_relations");

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group postCreateTasks
     *
     * @throws \Exception
     */
    public function testPostCreateTasks(){
        $pass = true; // if test passes
        $postType = factory(PostType::class)->create();
        PostType::createTable($postType->slug, []);
        PostType::createTable($postType->slug, [], "mysql_archive");

        $post = new Post();
        $post->setTable($postType->slug);
        // construct fake data for post
        $data = $this->constructFakePostData();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->content = $data['content'];
        $post->status = $data['status'];

        // truncate task data
        Task::truncate();

        if($post->save()){
            $archive = new Archive(false);
            $this->setParams($archive);
            $archive->countAndEstimateNumberOfPost();
            try{
                $archive->executeCUDTasks();
            }catch(\Exception $e){
                echo $e->getMessage();
            }

            if($this->checkTable($postType->slug)){
                // check if the data are correct (count the rows in the two tables)
                $pass = $this->countTableBetweenConnection($postType->slug);
            }else{
                $pass = false;
            }
        }else{
            $pass = false;
        }

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group postUpdateTasks
     *
     * @throws \Exception
     */
    public function testPostUpdateTasks(){
        $pass = true; // if test passes
        // create a post type in both connection (Main and Archive)
        $postType = $this->createPostType();
        // create post for the above post type
        $postID = $this->createPostWithDBBuilder($postType);

        $post = new Post();
        $post->setTable($postType->slug);
        $post = $post->where("postID", $postID)->first();

        // construct fake data for post
        $data = $this->constructFakePostData();
        $post->title = $data['title'];
        $post->slug = $data['slug'];
        $post->content = $data['content'];
        $post->status = $data['status'];

        // truncate task data
        Task::truncate();

        if($post->save()){
            $archive = new Archive(false);
            $this->setParams($archive);
            $archive->countAndEstimateNumberOfPost();
            try{
                $archive->executeCUDTasks();
            }catch(\Exception $e){
                echo $e->getMessage();
            }

            if($this->checkTable($postType->slug)){
                // check if the data are correct (count the rows in the two tables)
                $pass = $this->countTableBetweenConnection($postType->slug);
            }else{
                $pass = false;
            }
        }

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }


    /**
     * @group archive
     * @group postDeleteTasks
     *
     * @throws \Exception
     */
    public function testPostDeleteTasks(){
        $pass = true; // if test passes
        // create a post type in both connection (Main and Archive)
        $postType = $this->createPostType();
        // create post for the above post type
        $postID = $this->createPostWithDBBuilder($postType);
        // truncate task data
        Task::truncate();

        $post = new Post();
        $post->setTable($postType->slug);
        $post = $post->where("postID", $postID)->first();

        if($post->delete()){
            $archive = new Archive(false);
            $this->setParams($archive);
            $archive->countAndEstimateNumberOfPost();
            try{
                $archive->executeCUDTasks();
            }catch(\Exception $e){
                echo $e->getMessage();
            }

            if($this->checkTable($postType->slug)){
                // check if the data are correct (count the rows in the two tables)
                $pass = $this->countTableBetweenConnection($postType->slug);
            }else{
                $pass = false;
            }
        }

        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group categoryRelationsCreateTasks
     *
     * @throws \Exception
     */
    public function testCategoryRelationsCreateTasks(){
        $pass = $this->relationsCreateTest("category");
        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group tagRelationsCreateTasks
     *
     * @throws \Exception
     */
    public function testTagRelationsCreateTasks(){
        $pass = $this->relationsCreateTest("tag");
        $this->assertTrue($pass, "TEST FAILED. ASSERT FALSE");
    }

    /**
     * @group archive
     * @group deletePostsAboveLimit
     *
     * @throws \Exception
     */
    public function testDeletePostsAboveLimit(){
        Post::$postsAllowedInTable = 10;
        $postType = $this->createPostType();

        for($i=0; $i < 15; $i++){
            $this->createPostWithDBBuilder($postType, false);
        }

        $archive = new Archive(false);
        $this->setParams($archive);
        $archive->countAndEstimateNumberOfPost();
        try{
            $archive->deletePostsAboveLimit();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        $posts = DB::table($postType->slug)->count();
        $this->assertTrue($posts == Post::$postsAllowedInTable, "TEST FAILED. ASSERT FALSE");

    }


    /**
     * @param string $relation
     * @return bool
     * @throws \Exception
     */
    private function relationsCreateTest(string $relation){
        $pass = true;

        if($relation == 'category'){
            $primaryKey = 'categoryID';
            $table = "categories_relations";
        }elseif ($relation == 'tag'){
            $primaryKey = 'tagID';
            $table = "tags_relations";
        }else{
            throw new \Exception("Primary key doesn't exist");
        }
        // create a post type in both connection (Main and Archive)
        $postType = $this->createPostType();
        // truncate task data
        Task::truncate();

        $fakePostID = rand(9999,9999999);
        $relationID = rand(9999,9999999);

        $relationData[] = [
            $primaryKey => $relationID,
            'belongsToID' => $fakePostID,
            'belongsTo' => $postType->slug,
            "created_at" =>  \Carbon\Carbon::now(),
            "updated_at" => \Carbon\Carbon::now(),
        ];

        // create task
        Task::create($table, 'create', $relationData, ['postID' => $fakePostID, 'postType' => $postType->slug]);

        $archive = new Archive(false);
        $this->setParams($archive);
        $archive->countAndEstimateNumberOfPost();
        try{
            $archive->executeCUDTasks();
        }catch(\Exception $e){
            echo $e->getMessage();
        }

        $relation = $this->DBArchive->table($table)->where('belongsToID', $fakePostID)->where($primaryKey, $relationID)->first();
        if(!$relation){
            $pass = false;
        }

        return $pass;
    }

    /**
     * @return mixed
     */
    private function createPostType(){
        $postType = factory(PostType::class)->create();
        PostType::createTable($postType->slug, []);
        PostType::createTable($postType->slug, [], "mysql_archive");
        return $postType;
    }


    private function createPostWithDBBuilder(PostType $postType, bool $insertIntoArchive = true){
        // construct fake data for post
        $data = $this->constructFakePostData();

        $data['title'] = json_encode($data['title']);
        $data['slug'] = json_encode($data['slug']);
        $data['content'] = json_encode($data['content']);
        $data['status'] = json_encode($data['status']);

        $postID = DB::table($postType->slug)->insertGetId($data);
        $data['postID'] = $postID;
        if($insertIntoArchive){
            DB::connection("mysql_archive")->table($postType->slug)->insert($data);
        }

        return $postID;
    }

    /**
     * Used to construct fake post data
     * @return array
     */
    private function constructFakePostData(){
        $faker = Factory::create();
        $languages = Language::all();

        $data = ['title' => [], 'content' => [], 'status' => [], 'slug' => []];
        foreach($languages as $language){
            $data['title'][$language->slug] = $faker->text(12);
            $data['slug'][$language->slug] = $faker->slug(4);
            $data['content'][$language->slug] = $faker->text(200);
            $data['status'][$language->slug] = 'published';
        }
        return $data;
    }

    /**
     * @param string $table
     * @return bool
     */
    private function checkTable(string $table) : bool {
        if(Schema::connection("mysql")->hasTable($table) && Schema::connection("mysql_archive")->hasTable($table)){
            return true;
        }
        return false;
    }


    /**
     * Sets the DB, DBArchive and post type list to the service class (object)
     * @param Archive $archive object
     */
    private function setParams(Archive $archive){
        $this->DB = DB::connection('mysql');
        $this->DBArchive = DB::connection('mysql_archive');
        $this->allPostTypes = PostType::all();

        $archive->setDB($this->DB);
        $archive->setDBArchive($this->DBArchive);
        $archive->setPostTypes($this->allPostTypes);
        $archive->setCategoryRelationsTable((new CategoryRelation())->getTable());
        $archive->setTagRelationsTable((new TagRelation())->getTable());
    }

    /**
     * Check a table if has valid data between database connection
     * If main DB has rows and archive DB doesn't have rows returns false
     *
     * @param string $table
     * @return bool
     */
    private function countTableBetweenConnection(string $table){
        $mainDBTable = $this->DB->table($table)->count();
        $archiveDBTable = $this->DBArchive->table($table)->count();
        if($mainDBTable && !$archiveDBTable){
            return false;
        }
        return true;
    }

}
