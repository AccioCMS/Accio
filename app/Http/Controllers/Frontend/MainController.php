<?php

namespace App\Http\Controllers\Frontend;

use Accio\Theme\Controllers\BaseMainController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends BaseMainController{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}