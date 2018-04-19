<?php

namespace Tests\Browser;

use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use Faker\Factory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CustomFieldTest extends DuskTestCase{

    /**
     * Test custom field list
     *
     * @group customField
     * @group customFieldList
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testList(){
        $this->browse(function (Browser $browser) {
            $customFieldGroup = factory(CustomFieldGroup::class)->create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/custom-fields/list')
                ->waitUntilMissing('@spinner')
                ->assertVisible('@customFieldsListComponent');

            CustomFieldGroup::destroy($customFieldGroup->customFieldGroupID);
        });
    }

    /**
     * Test custom field bulk delete
     *
     * @group customField
     * @group customFieldBulkDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testBulkDelete(){
        $this->browse(function (Browser $browser){
            $customFieldGroup = factory(CustomFieldGroup::class)->create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/custom-fields/list')
                ->waitUntilMissing('@spinner')
                ->click('#ID'.$customFieldGroup->customFieldGroupID)
                ->click('#deleteList')
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');

            CustomFieldGroup::destroy($customFieldGroup->customFieldGroupID);
        });
    }

    /**
     * Test custom field delete
     *
     * @group customField
     * @group customFieldDelete
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testDelete(){
        $this->browse(function (Browser $browser){
            $customFieldGroup = factory(CustomFieldGroup::class)->create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/custom-fields/list')
                ->waitUntilMissing('@spinner')
                ->click('#toggleListBtn'.$customFieldGroup->customFieldGroupID)
                ->click('#deleteItemBtn'.$customFieldGroup->customFieldGroupID)
                ->waitFor('.noty_type__success')
                ->assertVisible('.noty_type__success');

            CustomFieldGroup::destroy($customFieldGroup->customFieldGroupID);
        });
    }

    /**
     * Test custom field create
     *
     * @group customField
     * @group customFieldCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        $this->browse(function (Browser $browser) {

            $faker = Factory::create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/custom-fields/create')
                ->type('#form-group-title input', $faker->text(10))
                ->type('#form-group-description input', $faker->text(20))
                ->click('#form-group-app .multiselect__select')
                ->click('#form-group-app .multiselect__content-wrapper ul li:nth-child(2)')
                ->pause(5000)
                ->click('#form-group-value .multiselect__select')
                ->click('#form-group-value .multiselect__content-wrapper ul li:nth-child(2)')
                ->click('#globalSaveBtn')
                ->waitForReload()
                ->waitFor('@customFieldEdit')
                ->assertVisible('@customFieldEdit');

        });
    }

    /**
     * Test custom field create
     *
     * @group customField
     * @group customFieldUpdate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testUpdate(){
        $this->browse(function (Browser $browser) {
            $faker = Factory::create();
            $customFieldGroup = factory(CustomFieldGroup::class)->create();

            $browser->loginAs(1, 'admin')
                ->visit('admin/'.\App::getLocale().'/custom-fields/update/'.$customFieldGroup->customFieldGroupID)
                ->type('#form-group-title input', $faker->text(10))
                ->type('#form-group-description input', $faker->text(20))
                ->click('#addGroup')
                ->click('#form-group-app .multiselect__select')
                ->click('#form-group-app .multiselect__content-wrapper ul li:nth-child(2)')
                ->pause(5000)
                ->click('#form-group-value .multiselect__select')
                ->click('#form-group-value .multiselect__content-wrapper ul li:nth-child(2)')
                ->click('#globalSaveBtn')
                ->waitForReload()
                ->waitFor('@customFieldEdit')
                ->assertVisible('@customFieldEdit');

            CustomFieldGroup::destroy($customFieldGroup->customFieldGroupID);

        });
    }

}
