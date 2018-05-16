<?php

namespace Tests\Browser;

use Accio\App\Traits\UserTrait;
use App;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LanguageTest extends DuskTestCase{
    use UserTrait;


    /**
     * Test language list
     *
     * @group language
     * @group languageList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.App::getLocale().'/language/list')
                ->waitUntilMissing('@spinner')
                ->assertVisible('@languageListComponent');
        });
    }

    /**
     * Test language create
     *
     * @group language
     * @group languageCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {

            $faker = null;
            while(true){
                $faker = Factory::create();
                $lang = App\Models\Language::findBySlug($faker->languageCode);
                if($lang == null){
                    break;
                }
            }

            if ($faker){
                $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                    ->visit('admin/en/language/create')
                    ->waitUntilMissing('@spinner')
                    ->select('#name')
                    ->click('#globalSaveBtn')
                    ->waitForReload()
                    ->assertVisible('@languageUpdateComponent');
            }
        });
    }


    /**
     * Test language update
     *
     * @group language
     * @group languageUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {
            $language = factory(App\Models\Language::class)->create();

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.App::getLocale().'/language/update/'.$language->languageID)
                ->waitUntilMissing('@spinner')
                ->click('#globalSaveBtn')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');

            App\Models\Language::destroy($language->languageID);
        });
    }

    /**
     * Test language bulk delete
     *
     * @group language
     * @group languageBulkDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $language = factory(App\Models\Language::class)->create();
            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.App::getLocale().'/language/list')
                ->waitUntilMissing('@spinner')
                ->click('#ID'.$language->languageID)
                ->click('#deleteList')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }

    /**
     * Test language delete
     *
     * @group language
     * @group languageDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $language = factory(App\Models\Language::class)->create();
            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/'.App::getLocale().'/language/list')
                ->waitUntilMissing('@spinner')
                ->click('#toggleListBtn'.$language->languageID)
                ->click('#deleteItemBtn'.$language->languageID)
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }
}
