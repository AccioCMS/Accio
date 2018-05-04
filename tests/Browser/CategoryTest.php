<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\Language;
use App\Models\PostType;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryTest extends DuskTestCase{
    /**
     * Test category list
     *
     * @group category
     * @group categoryList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $postType = factory(PostType::class)->create();
            // Create table if it doesn't exist
            PostType::createTable($postType->slug, []);

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/categorylist/'.$postType->postTypeID)
                ->waitUntilMissing('@spinner')
                ->assertVisible('@categoryListComponent');

            $postTypeFromDB = PostType::find($postType->postTypeID);
            if($postTypeFromDB->delete()){
                Schema::drop($postTypeFromDB->slug);
            }
        });
    }

    /**
     * Test category bulk delete
     *
     * @group category
     * @group categoryBulkDelete
     *
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            $faker = Factory::create();
            $title = [];
            $description = [];
            $slug = [];
            $isVisible = [];
            foreach (Language::all() as $language){
                $title[$language->slug] = $faker->name(8);
                $description[$language->slug] = $faker->name(15);
                $slug[$language->slug] = $faker->slug;
                $isVisible[$language->slug] = 1;
            }

            $category = new Category();
            $category->createdByUserID = 1;
            $category->postTypeID = $postType->postTypeID;
            $category->title = $title;
            $category->description = $description;
            $category->slug = $slug;
            $category->isVisible = $isVisible;
            $category->order = Category::all()->count();

            if($category->save()){
                $browser->loginAs(1, 'admin')
                    ->visit('admin/'.\App::getLocale().'/post-type/categorylist/'.$postType->postTypeID)
                    ->waitUntilMissing('@spinner')
                    ->click('#ID'.$category->categoryID)
                    ->click('#deleteList')
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');

                PostType::find($postType->postTypeID)->delete();
            }

        });
    }

    /**
     *
     * Test category delete
     *
     * @group category
     * @group categoryDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            $faker = Factory::create();
            $title = [];
            $description = [];
            $slug = [];
            $isVisible = [];
            foreach (Language::all() as $language){
                $title[$language->slug] = $faker->name(8);
                $description[$language->slug] = $faker->name(15);
                $slug[$language->slug] = $faker->slug;
                $isVisible[$language->slug] = 1;
            }

            $category = new Category();
            $category->createdByUserID = 1;
            $category->postTypeID = $postType->postTypeID;
            $category->title = $title;
            $category->description = $description;
            $category->slug = $slug;
            $category->isVisible = $isVisible;
            $category->order = Category::all()->count();

            if($category->save()){
                $browser->loginAs(1, 'admin')
                    ->visit('admin/'.\App::getLocale().'/post-type/categorylist/'.$postType->postTypeID)
                    ->waitUntilMissing('@spinner')
                    ->click('#toggleListBtn' . $category->categoryID)
                    ->click('#deleteItemBtn' . $category->categoryID)
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');

                PostType::find($postType->postTypeID)->delete();
            }
        });
    }


    /**
     * Test category create
     *
     * @group category
     * @group categoryCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {

            $postType = factory(PostType::class)->create();
            $faker = Factory::create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/categorycreate/'.$postType->postTypeID)
                ->waitUntilMissing('@spinner')
                ->click('#form-group-featuredImage #openMediaFeatureImage')
                ->pause(1000)
                ->click('.imageWrapper:first-child')
                ->click('@chooseMedia')
                ->waitUntilMissing('@popupContentLibrary');

            foreach(Language::getFromCache() as $lang){
                $browser->click('#tabBtn-'.$lang->slug)
                    ->type('#form-group-title_'.$lang->slug.' input', $faker->name(10))
                    ->pause(3000)
                    ->type('#form-group-description_'.$lang->slug.' .fr-view', $faker->paragraph());
            }
            $browser->click('#globalSaveBtn')
                ->waitFor('@categoryUpdateComponent')
                ->assertVisible('@categoryUpdateComponent');

            Category::where("postTypeID",$postType->postTypeID)->delete();
            PostType::destroy($postType->postTypeID);
        });
    }

    /**
     * Test category update
     *
     * @group category
     * @group categoryUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {

            $postType = factory(PostType::class)->create();
            $faker = Factory::create();
            $title = [];
            $description = [];
            $slug = [];
            $isVisible = [];
            foreach (Language::all() as $language){
                $title[$language->slug] = $faker->name(8);
                $description[$language->slug] = $faker->name(15);
                $slug[$language->slug] = $faker->slug;
                $isVisible[$language->slug] = 1;
            }

            $category = new Category();
            $category->createdByUserID = 1;
            $category->postTypeID = $postType->postTypeID;
            $category->title = $title;
            $category->description = $description;
            $category->slug = $slug;
            $category->isVisible = $isVisible;
            $category->order = Category::all()->count();

            if($category->save()) {
                $browser->loginAs(1, 'admin')
                    ->visit('admin/'.\App::getLocale().'/post-type/categoryupdate/'.$category->categoryID)
                    ->waitUntilMissing('@spinner')
                    ->click('#form-group-featuredImage #openMediaFeatureImage')
                    ->waitUntilMissing('.loadingOpened',10)
                    ->click('.imageWrapper:first-child')
                    ->click('@chooseMedia')
                    ->waitUntilMissing('@popupContentLibrary');

                foreach(Language::getFromCache() as $lang){
                    $browser->click('#tabBtn-'.$lang->slug)
                        ->type('#form-group-title_'.$lang->slug.' input', $faker->name(10))
                        ->pause(3000)
                        ->type('#form-group-description_'.$lang->slug.' .fr-view', $faker->paragraph());
                }
                $browser->click('#globalSaveBtn')
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');

                Category::where("postTypeID",$postType->postTypeID)->delete();
                PostType::destroy($postType->postTypeID);
            }
        });
    }


}
