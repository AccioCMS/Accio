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

    public function addCategoryToMenu($menu, $postTypeSLug = 'post_articles'){
        $categoryRelation = (new CategoryRelation)->setTable($postTypeSLug.'_categories')->first();
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
     * Add homepage example to primary Menu.
     *
     * @param $menu
     * @throws Exception
     */
    public function addHomepageToPrimaryMenu($menu){

        // Ensure there is only one front page
        $homepageID = \App\Models\Settings::getSetting('homepageID');
        $postObj = (new \App\Models\Post())->setTable('post_pages');
        $gethomepage = $postObj->where('postID', $homepageID)->first();

        if(!$gethomepage) {

            // Create Post
            $data = [];
            foreach (\App\Models\Language::all() as $language) {
                $data['title'][$language->slug] = 'Home';
                $data['slug'][$language->slug] = 'home';
            }

            $post = (new PostDevSeeder())->createPost(getPostType('post_pages'), null, null, null, $data);

            // Add to menulink
            $menuLinkData = [
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
                $menuLinkData['slug'][$language->slug] = $post->translate($language->slug)->slug;
                $menuLinkData['label'][$language->slug] = $post->title;
            }

            // Create MenuLink
            factory(\App\Models\MenuLink::class)->create($menuLinkData);

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

        $post = (new PostDevSeeder())->createPost($postPages, null, null, null, $data);

        // Add to menulink
        $menuLinkData = [
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
            $menuLinkData['slug'][$language->slug] = $post->translate($language->slug)->slug;
            $menuLinkData['label'][$language->slug] = $post->title;
        }

        // Create MenuLink
        factory(\App\Models\MenuLink::class)->create($menuLinkData);
    }
}
