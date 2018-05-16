<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\CategoryRelation;
use App\Models\Category;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\MenuLink::class)->create();
    }

    public function addCategoryToMenu($menu){
        $categoryRelation = CategoryRelation::where('belongsTo', 'post_articles')->get()->first();
        if($categoryRelation) {
            $category = Category::where('categoryID', $categoryRelation->categoryID)->get()->first();
            $category->addToMenu($menu);
        }
        return;
    }

    /**
     * Create primary menu (if it doesn't exist
     * @return object
     */
    public function createPrimaryMenu(){
        $menu = Menu::where('slug', 'primary')->get()->first();
        if(!$menu){
            $menu = factory(Menu::class)->create([
                'title' => 'Primary',
                'slug' => 'primary',
                'isPrimary' => true,
            ]);
        }
        return $menu;
    }

    /**
     * Add homepage example to primary Menu
     * @param object $menu
     * @return object
    */
    public function addHomepageToPrimaryMenu($menu){

        // Ensure there is only one front page
        $homepageID = \App\Models\Settings::getSetting('homepageID');
        $postObj = (new \App\Models\Post())->setTable('post_pages');
        $gethomepage = $postObj->where('postID', $homepageID)->first();

        if(!$gethomepage) {

            // Get Post Type
            $postPages = \App\Models\PostType::where('slug', 'post_pages')->get()->first();

            // Create Post
            $data = [];
            foreach (\App\Models\Language::all() as $language) {
                $data['title'][$language->slug] = 'Home';
                $data['slug'][$language->slug] = 'home';
            }

            $postHomePage = (new PostDevSeeder())->createPost($postPages, null, null, null, $data);
            $post = $postHomePage['post'];

            // Add to menulink
            $data = [
                'menuID' => $menu->menuID,
                'belongsToID' => $post->postID,
                'belongsTo' => 'post_pages',
                'params' => [
                    'postID' => $post->postID,
                    'postSlug' => $post->slug,
                    'date' => date('Y-m-d', strtotime($post->created_at)),
                    'postTypeSlug' => 'pages',
                ],
                'routeName' => 'base.homepage'
            ];

            foreach (\App\Models\Language::all() as $language) {
                $data['slug'][$language->slug] = $post->translate($language->slug)->slug;
                $data['label'][$language->slug] = $post->title;
            }

            // Create MenuLink
            factory(\App\Models\MenuLink::class)->create($data);

            // Set front page ID as a homepage in settings
            \App\Models\Settings::setSetting('homepageID', $post->postID);
        }
    }

    /**
    * Add About example to primary Menu
    * @param object $menu
    */
    public  function addAboutToPrimaryMenu($menu){
        // Get Post Pages
        $postPages = \App\Models\PostType::where('slug', 'post_pages')->get()->first();

        // Create Post
        $data = [];
        foreach(\App\Models\Language::all() as $language){
            $data['title'][$language->slug] = 'About';
            $data['slug'][$language->slug] = 'about';
        }

        $postHomePage = (new PostDevSeeder())->createPost($postPages, null, null, null, $data);
        $post = $postHomePage['post'];

        // Add to menulink
        $data = [
            'menuID' => $menu->menuID,
            'belongsToID' => $post->postID,
            'belongsTo' => 'post_pages',
            'params' => [
                'postID'        => $post->postID,
                'postSlug'      => $post->slug,
                'date'          => date('Y-m-d',strtotime($post->created_at)),
                'postTypeSlug'  => 'pages',
            ],
            'routeName'  => 'post.pages.single'
        ];

        foreach(\App\Models\Language::all() as $language){
            $data['slug'][$language->slug] = $post->translate($language->slug)->slug;
            $data['label'][$language->slug] = $post->title;
        }

        // Create MenuLink
        factory(\App\Models\MenuLink::class)->create($data);
    }
}
