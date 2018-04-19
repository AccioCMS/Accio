<?php

namespace Tests\Browser;

use App\Http\Controllers\Backend\BaseMenuController;
use Faker\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\File;

class MenuTest extends DuskTestCase{

    /**
     * Test menu and menu link create
     *
     * @group menu
     * @group menuCreate
     *
     * @return void
     * @throws \Exception
     * @throws \Throwable
     */
    public function testCreate(){
        URL::defaults(['lang' => App::getLocale()]);

        $postTypeSeed = new \PostTypeDevSeeder();
        $postTypeSeed->run(1);

        $categorySeed = new \CategoryDevSeeder();
        $categorySeed->run(1);

        $postSeed = new \PostDevSeeder();
        $postSeed->run(1);

        $this->browse(function (Browser $browser) {
            $faker = Factory::create();

            $models = File::files(base_path('app/Models'));
            $panels = [];
            foreach($models as $file) {
                $modelName = str_replace('.php', '', $file->getFileName()); // extract model name
                $modelClass = 'App\\Models\\' . $modelName;

                if (method_exists($modelClass, 'menuLinkPanel')){
                    $menuPanels = $modelClass::menuLinkPanel();
                    // handle one dimension menuLinkRoutes
                    if(isset($menuPanels['items'])){
                        $panels[] = $menuPanels;
                    }else{
                        foreach($menuPanels as $panelKey => $panel){
                            $panels[] = $panel;
                        }
                    }
                }
            }

            $browser->loginAs(1, 'admin')
                ->visit('admin/en/menu/list/1')
                ->click('.createMenuBtn')
                ->type('.menuNameInput', $faker->name(6));

            foreach ($panels as $key => $panel){
                $browser->click('#panel-'.$key.' a')
                    ->waitUntilMissing('#panel-'.$key.'-spinner')
                    ->click('#panel-'.$key.' table tbody tr:first-child td:first-child input')
                    ->click('#panel-'.$key.' .selectLinkBtn')
                    ->click('#panel-'.$key.' a');
            }

            $browser->click('#globalSaveBtn')
                ->waitForReload()
                ->assertVisible('@menuComponent');
        });
    }
}