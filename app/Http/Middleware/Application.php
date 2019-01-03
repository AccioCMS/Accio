<?php

namespace App\Http\Middleware;

use Closure;

class Application extends  \Accio\Middleware\Application {

    /**
     * Handle backend incoming request.
     *
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\Response|mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next){
        return parent::handle($request, $next);
    }
}
