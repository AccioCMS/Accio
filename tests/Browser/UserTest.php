<?php
namespace Tests\Browser;

use App\Models\Language;
use App\Models\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends DuskTestCase{
    /**
     * Test user list
     *
     * @group user
     * @group userList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/user/list')
                ->waitUntilMissing('@spinner')
                ->assertVisible('@userListComponent');
        });
    }

    /**
     * Test user create
     *
     * @group user
     * @group userCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {
            $faker = Factory::create();
            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/user/create')
                ->waitUntilMissing('@spinner')
                ->type('#form-group-name input', $faker->name)
                ->type('#form-group-lastname input', $faker->lastName)
                ->type('#form-group-email input', $faker->email)
                ->type('#form-group-password input', 123456)
                ->type('#form-group-confpassword input', 123456)
                ->type('#form-group-phone input', $faker->phoneNumber)
                ->type('#form-group-street input', $faker->streetName)
                ->type('#form-group-country input', $faker->country)
                ->type('#form-group-phone input', $faker->country)
                ->click('#form-group-groups .multiselect__select')
                ->click('#form-group-groups .multiselect__content-wrapper ul li:first-child')
                ->click('#form-group-featuredImage #openMediaFeatureImage')
                ->waitUntilMissing('.loadingOpened')
                ->click('.imageWrapper:first-child')
                ->click('@chooseMedia')
                ->waitUntilMissing('@popupContentLibrary');

            foreach(Language::getFromCache() as $lang){
                $browser->click('#tabBtn-'.$lang->slug)
                    ->type('#form-group-about_'.$lang->slug.' .fr-view', $faker->paragraph);
            }
            $browser->click('#globalSaveBtn')
                ->waitFor('@userUpdateComponent')
                ->assertVisible('@userUpdateComponent');
        });
    }

    /**
     * Test user bulk delete
     *
     * @group user
     * @group userBulkDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $user = factory(User::class)->create();
            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/user/list')
                ->waitUntilMissing('@spinner')
                ->click('#ID'.$user->userID)
                ->click('#deleteList')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }

    /**
     * Test user delete
     *
     * @group user
     * @group userDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $user = factory(User::class)->create();
            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/user/list')
                ->waitUntilMissing('@spinner')
                ->click('#toggleListBtn'.$user->userID)
                ->click('#deleteItemBtn'.$user->userID)
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');
        });
    }

    /**
     * Test user update
     *
     * @group user
     * @group userUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser){
            $user = factory(User::class)->create();

            $faker = Factory::create();
            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/user/update/'.$user->userID)
                ->waitUntilMissing('@spinner')
                ->type('#form-group-name input', $faker->name)
                ->type('#form-group-lastname input', $faker->lastName)
                ->type('#form-group-email input', $faker->email)
                ->type('#form-group-phone input', $faker->phoneNumber)
                ->type('#form-group-street input', $faker->streetName)
                ->type('#form-group-country input', $faker->country)
                ->type('#form-group-phone input', $faker->country)
                ->click('#form-group-groups .multiselect__select')
                ->click('#form-group-groups .multiselect__content-wrapper ul li:first-child')
                ->click('#form-group-featuredImage #openMediaChangeFeatureImage')
                ->waitUntilMissing('.loadingOpened')
                ->click('.imageWrapper:first-child')
                ->click('@chooseMedia')
                ->waitUntilMissing('@popupContentLibrary');

            foreach(Language::getFromCache() as $lang){
                $browser->click('#tabBtn-'.$lang->slug)
                    ->type('#form-group-about_'.$lang->slug.' .fr-view', $faker->paragraph);
            }
            $browser->click('#globalSaveBtn')
                ->waitFor('@userUpdateComponent')
                ->assertVisible('@userUpdateComponent');
        });
    }

}
