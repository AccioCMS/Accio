<?php

namespace App\Http\Middleware;

use Closure;

class Frontend extends \Manaferra\App\Http\Middleware\Frontend
{
    /**
     * Handle frontend incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        return parent::handle($request, $next);
    }
}
