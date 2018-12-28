<?php

namespace App\Models;

use Accio\Post\Models\PostModel;

class Article extends PostModel {

    public $table = "post_articles";

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }
}
