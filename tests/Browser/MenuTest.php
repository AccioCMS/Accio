<?php

namespace Tests\Browser;

use Accio\App\Traits\UserTrait;
use App\Http\Controllers\Backend\BaseMenuController;
use App\Models\Menu;
use App\Models\MenuLink;
use Faker\Factory;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\File;

class MenuTest extends DuskTestCase{

    use UserTrait;


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

        $categorySeed = new \CategorySeeder();
        $categorySeed->run(1);

        $postSeed = new \PostSeeder();
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

            $browser->loginAs($this->getAnAdmin()->userID, 'admin')
                ->visit('admin/en/menu/list/1')
                ->waitUntilMissing('@spinner')
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
                ->waitUntilMissing('@spinner')
                ->assertVisible('@menuComponent');

            $menu = Menu::orderBy('created_at', 'desc')->first();
            MenuLink::where('menuID', $menu->menuID)->delete();
            $menu->delete();
        });
    }
}
