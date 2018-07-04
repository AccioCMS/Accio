<?php

namespace Tests\Browser;

use Accio\App\Traits\UserTrait;
use App\Models\Category;
use App\Models\Language;
use App\Models\Media;
use App\Models\PostType;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Input\InputInterface;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PostTest extends DuskTestCase{

    use UserTrait;


    /**
     * Test post list
     *
     * @group post
     * @group postList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $postType = factory(PostType::class)->create();
            PostType::createTable($postType->slug, []);

            $postSeed = new \PostDevSeeder();
            $postSeed->createPost($postType);

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/posts/'.$postType->slug.'/list')
                ->waitUntilMissing('@spinner')
                ->assertVisible('@postListComponent');

            PostType::destroy($postType->postTypeID);
            Schema::drop($postType->slug);
        });
    }

    /**
     * Test post bulk delete
     *
     * @group post
     * @group postBulkDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            // Create table if it doesn't exist
            PostType::createTable($postType->slug, []);

            $postSeed = new \PostDevSeeder();
            $postSeed->createPost($postType);

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/posts/'.$postType->slug.'/list')
                ->waitUntilMissing('@spinner')
                ->click('#ID1')
                ->click('#deleteList')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');

            PostType::destroy($postType->postTypeID);
            Schema::drop($postType->slug);
        });
    }

    /**
     * Test post create
     *
     * @group post
     * @group postCreate
     *
     * @throws \Exception
     * @throws \Throwable
     *
     * @return void
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {
            $postType = factory(PostType::class)->create();
            PostType::createTable($postType->slug, []);

            $categorySeed = new \CategoryDevSeeder();
            $categorySeed->run(2, $postType->slug);

            $tagSeed = new \TagDevSeeder();
            $tagSeed->run(2, $postType->slug);

            $faker = Factory::create();

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/posts/'.$postType->slug.'/create')
                ->waitUntilMissing('@spinner',20)
                ->click('#form-group-featuredImage #openMediaChangeFeatureImage')
                ->waitUntilMissing('.loadingOpened')
                ->click('.imageWrapper:first-child')
                ->click('@chooseMedia')
                ->waitUntilMissing('@popupContentLibrary');

            foreach(Language::cache()->getItems() as $language){
                $browser->click('#tabBtn-'.$language->slug)
                    ->type('#form-group-title_'.$language->slug.' input', $faker->text(10))
                    ->type('#form-group-content_'.$language->slug.' .fr-view', $faker->paragraph);
                    if($language->isDefault){
                        $browser->click('#form-group-categories_' . $language->slug . ' .multiselect__tags')
                            ->click('#form-group-categories_' . $language->slug . ' .multiselect__content-wrapper ul li:first-child');
                    }

                $browser->pause(1000);
                $browser->click('#form-group-tags_' . $language->slug . ' .multiselect__tags')
                    ->type('#form-group-tags_' . $language->slug . ' .multiselect__input', $faker->text(5))
                    ->keys('#form-group-tags_' . $language->slug . ' .multiselect__input', ['{enter}']);

                $browser->pause(2000);
            }

            $browser->click('#globalSaveBtn')
                ->waitFor('@postUpdateComponent')
                ->assertVisible('@postUpdateComponent');

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Category::where('postTypeID', $postType->postTypeID);
            PostType::destroy($postType->postTypeID);
            Schema::drop($postType->slug);

        });
    }

    /**
     * Test post update
     *
     * @group post
     * @group postUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {
            $faker = Factory::create();

            // create a image
            factory(Media::class)->create()->makeThumb(200, 200);

            $postType = factory(PostType::class)->create();
            PostType::createTable($postType->slug, []);

            $categorySeed = new \CategoryDevSeeder();
            $categorySeed->run(2, $postType->slug);

            // Set posts table
            $post = new \App\Models\Post();
            $post->setTable($postType->slug);

            $title = [];
            $status = [];
            $content = [];
            $slug = [];
            foreach(Language::cache()->getItems() as $language){
                $title[$language->slug] = $faker->text(15);
                $status[$language->slug] = "published";
                $content[$language->slug] = $faker->paragraph;
                $slug[$language->slug] = $faker->slug;
            }

            $post->title = $title;
            $post->status = $status;
            $post->content = $content;
            $post->slug = $slug;
            $post->customFields = [];
            $post->createdByUserID = 1;
            $post->published_at = Carbon::now();

            if($post->save()){
                $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                    ->visit('admin/'.\App::getLocale().'/posts/'.$postType->slug.'/update/'.$post->postID)
                    ->waitUntilMissing('@spinner',20)
                    ->click('#form-group-featuredImage #openMediaChangeFeatureImage')
                    ->waitUntilMissing('.loadingOpened')
                    ->click('.imageWrapper:first-child')
                    ->click('@chooseMedia')
                    ->waitUntilMissing('@popupContentLibrary');

                foreach(Language::cache()->getItems() as $language){
                    $browser->click('#tabBtn-'.$language->slug)
                        ->type('#form-group-title_'.$language->slug.' input', $faker->text(10))
                        ->type('#form-group-content_'.$language->slug.' .fr-view', $faker->paragraph);
                    if($language->isDefault){
                        $browser->click('#form-group-categories_' . $language->slug . ' .multiselect__tags')
                            ->click('#form-group-categories_' . $language->slug . ' .multiselect__content-wrapper ul li:first-child')
                            ->click('');
                    }
                    $browser->pause(1000);

                    $browser->click('#form-group-tags_' . $language->slug . ' .multiselect__tags')
                        ->type('#form-group-tags_' . $language->slug . ' .multiselect__input', $faker->text(5))
                        ->keys('#form-group-tags_' . $language->slug . ' .multiselect__input', ['{enter}']);

                    $browser->pause(2000);
                }

                $browser->click('#globalSaveBtn')
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');
            }

            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Category::where('postTypeID', $postType->postTypeID);
            PostType::destroy($postType->postTypeID);
            Schema::drop($postType->slug);
        });
    }
}
