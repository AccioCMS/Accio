<?php

namespace App\Http\Middleware;

use Closure;

class Backend extends  \Accio\App\Http\Middleware\Backend{
    /**
     * Handle backend incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        return parent::handle($request, $next);
    }
}
