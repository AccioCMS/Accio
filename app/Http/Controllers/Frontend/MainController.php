<?php

namespace App\Http\Controllers\Frontend;

use App\Models\MenuLink;
use App\Models\Post;
use App\Models\Theme;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Symfony\Component\Process\Process;

class MainController extends BaseController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(Request $request){

        // As route middlewares are not called when routes are cached
        // we need to call them manually
        if(App::routesAreCached()) {
            $this->middleware('frontend');
        }
    }

    /**
     * Get getMenuLinkRoutes from a controller
     *
     * @param string $controller
     * @return array
     */
    public static function getMenuLinkRoutes($controller){
        $controllerClass = Theme::getNamespace().'\\Controllers\\'.$controller;

        $routes = [];

        if(class_exists($controllerClass) && method_exists($controllerClass, 'menuLinkRoutes' )){
            $routes = array_merge($routes, $controllerClass::menuLinkRoutes());
        }

        return $routes;
    }
}