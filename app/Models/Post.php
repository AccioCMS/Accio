<?php

/**
 * Posts
 *
 * Due to its nature, Posts model are managed dynamically by UI, via PostTypes
 *
 * @author Jetmir Haxhisefa <jetmir.haxhisefa@Accio.com>
 * @author Faton Sopa <faton.sopa@Accio.com>
 * @version 1.0
 */
namespace App\Models;

use Accio\App\Models\PostModel;

class Post extends PostModel {

    /**
     * Configure if post model has dynamic tables or pre-declared table
     *
     * @return bool
     */
    protected function setHasDynamicTable(): bool{
        return true;
    }
}
