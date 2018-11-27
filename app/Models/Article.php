<?php

/**
 * Article
 *
 * Due to its nature, Posts model are managed dynamically by UI, via PostTypes
 *
 * @author Jetmir Haxhisefa <jetmir.haxhisefa@Accio.com>
 * @author Faton Sopa <faton.sopa@Accio.com>
 * @version 1.0
 */
namespace App\Models;

use Accio\App\Interfaces\ElasticSearchInterface;
use Accio\App\Models\PostModel;
use Accio\App\Traits\ElasticSearchTrait;
use Illuminate\Support\Facades\Event;

class Article extends PostModel implements ElasticSearchInterface {
    use ElasticSearchTrait;

    public $table = "post_jobs";

    /**
     * Enable elastic
     * @var bool
     */
    protected $hasElastic = true;

    public function __construct(array $attributes = []){
        parent::__construct($attributes);

        Event::listen('post:stored', function ($data, $postObj){
            if(method_exists($this, "createElasticDocument")){
                $this->addItemOnES($postObj);
            }
        });

        Event::listen('post:deleted', function ($post) {
            if(method_exists($this, "deleteElasticDocument")){
                $this->deleteElasticDocument($post->postID);
            }
        });
    }


    /**
     * Configure if post model has dynamic tables or pre-declared table
     *
     * @return bool
     */
    protected function setHasDynamicTable(): bool{
        return false;
    }

    /**
     * Set mapping for Elequent
     */
    public function setMapping(): void {
        // TODO: Implement setMapping() method.
    }


}