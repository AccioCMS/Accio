<?php

namespace Tests\Browser;

use Accio\App\Traits\UserTrait;
use App\Models\Category;
use App\Models\Language;
use App\Models\PostType;
use App\Models\Tag;
use Faker\Factory;
use Illuminate\Support\Facades\Schema;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class TagTest extends DuskTestCase{
    use UserTrait;


    /**
     * Test tag list
     *
     * @group tag
     * @group tagList
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

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/taglist/'.$postType->postTypeID)
                ->waitUntilMissing('@spinner')
                ->pause(1000)
                ->assertVisible('@tagListComponent');

            $postTypeFromDB = PostType::find($postType->postTypeID);
            if($postTypeFromDB->delete()){
                Schema::drop($postTypeFromDB->slug);
            }
        });
    }

    /**
     * Test tag bulk delete
     *
     * @group tag
     * @group tagBulkDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            $faker = Factory::create();

            $tag = new Tag();
            $tag->createdByUserID = 1;
            $tag->postTypeID = $postType->postTypeID;
            $tag->title = $faker->name(10);
            $tag->description = $faker->paragraph(1);
            $tag->slug = $faker->slug;

            if($tag->save()){
                $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                    ->visit('admin/'.\App::getLocale().'/post-type/taglist/'.$postType->postTypeID)
                    ->waitUntilMissing('@spinner')
                    ->click('#ID'.$tag->tagID)
                    ->click('#deleteList')
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');

                PostType::find($postType->postTypeID)->delete();
            }

        });
    }

    /**
     * Test tag delete
     *
     * @group tag
     * @group tagDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            $faker = Factory::create();

            $tag = new Tag();
            $tag->createdByUserID = 1;
            $tag->postTypeID = $postType->postTypeID;
            $tag->title = $faker->name(10);
            $tag->description = $faker->paragraph(1);
            $tag->slug = $faker->slug;

            if($tag->save()) {
                $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                    ->visit('admin/'.\App::getLocale().'/post-type/taglist/'.$postType->postTypeID)
                    ->waitUntilMissing('@spinner')
                    ->click('#toggleListBtn' . $tag->tagID)
                    ->click('#deleteItemBtn' . $tag->tagID)
                    ->waitFor('.noty_type__success')
                    ->assertVisible('.noty_type__success');

                PostType::find($postType->postTypeID)->delete();
            }
        });
    }

    /**
     * Test tag create
     *
     * @group tag
     * @group tagCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {

            $postType = factory(PostType::class)->create();
            $faker = Factory::create();

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/tagcreate/'.$postType->postTypeID)
                ->waitUntilMissing('@spinner')
                ->click('#form-group-featuredImage #openMediaFeatureImage')
                ->waitUntilMissing('.loadingOpened')
                ->click('.imageWrapper:first-child')
                ->click('@chooseMedia')
                ->waitUntilMissing('@popupContentLibrary')
                ->type('#form-group-title input', $faker->name(10))
                ->pause(3000)
                ->type('#form-group-description .fr-view', $faker->paragraph())
                ->click('#globalSaveBtn')
                ->waitFor('@tagUpdateComponent')
                ->assertVisible('@tagUpdateComponent');

            Tag::where("postTypeID",$postType->postTypeID)->delete();
            PostType::destroy($postType->postTypeID);

        });
    }

    /**
     * Test tag update
     *
     * @group tag
     * @group tagUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {

            $postType = factory(PostType::class)->create();
            $faker = Factory::create();

            $tag = new Tag();
            $tag->createdByUserID = 1;
            $tag->postTypeID = $postType->postTypeID;
            $tag->title = $faker->name(10);
            $tag->description = $faker->paragraph(1);
            $tag->slug = $faker->slug(5);

            if($tag->save()) {
                $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                    ->visit('admin/' . \App::getLocale() . '/post-type/tagupdate/' . $tag->tagID)
                    ->waitUntilMissing('@spinner')
                    ->click('#form-group-featuredImage #openMediaFeatureImage')
                    ->waitUntilMissing('.loadingOpened')
                    ->click('.imageWrapper:first-child')
                    ->click('@chooseMedia')
                    ->waitUntilMissing('@popupContentLibrary')
                    ->type('#form-group-title input', $faker->name(10))
                    ->pause(3000)
                    ->type('#form-group-description .fr-view', $faker->paragraph())
                    ->click('#globalSaveBtn')
                    ->waitFor('@tagUpdateComponent')
                    ->assertVisible('@tagUpdateComponent');

                Tag::where("postTypeID", $postType->postTypeID)->delete();
                PostType::destroy($postType->postTypeID);
            }
        });
    }
}
