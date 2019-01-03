<?php

namespace App\Http\Middleware;

use Closure;

class Frontend extends \Accio\Middleware\Frontend
{
    /**
     * Handle frontend incoming request.
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
