<?php

namespace Tests\Browser;

use Accio\App\Traits\UserTrait;
use App\Models\PostType;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class PostTypeTest extends DuskTestCase{
    use UserTrait;


    /**
     * Test post type list
     *
     * @group postType
     * @group postTypeList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/list')
                ->waitUntilMissing('@spinner')
                ->assertVisible('@postTypeListComponent');
        });
    }

    /**
     * Test post type bulk delete
     *
     * @group postType
     * @group postTypeBulkDelete
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

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/list')
                ->waitUntilMissing('@spinner')
                ->click('#ID'.$postType->postTypeID)
                ->click('#deleteList')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }

    /**
     * Test post type delete
     *
     * @group postType
     * @group postTypeDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $postType = factory(PostType::class)->create();
            // Create table if it doesn't exist
            PostType::createTable($postType->slug, []);

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/list')
                ->waitUntilMissing('@spinner')
                ->click('#toggleListBtn'.$postType->postTypeID)
                ->click('#deleteItemBtn'.$postType->postTypeID)
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }

    /**
     * Test post type create
     *
     * @group postType
     * @group postTypeCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {

            $faker = Factory::create();

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/create')
                ->waitUntilMissing('@spinner')
                ->type('#form-group-name input', $faker->text(10))
                ->click('#form-group-hasCategories .yes')
                ->click('#form-group-hasTags .yes')
                ->pause('5000')
                ->click('#globalSaveBtn')
                ->waitFor('@postTypeUpdateComponent')
                ->assertVisible('@postTypeUpdateComponent');
        });
    }

    /**
     * Test post type update
     *
     * @group postType
     * @group postTypeUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {
            $postType = factory(PostType::class)->create();
            PostType::createTable($postType->slug, []);

            $faker = Factory::create();

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.\App::getLocale().'/post-type/update/'.$postType->postTypeID)
                ->waitUntilMissing('@spinner')
                ->type('#form-group-name input', $faker->text(10))
                ->click('#globalSaveBtn')
                ->waitForReload()
                ->waitFor('@postTypeUpdateComponent')
                ->assertVisible('@postTypeUpdateComponent');

            PostType::destroy($postType->postTypeID);
        });
    }


}
