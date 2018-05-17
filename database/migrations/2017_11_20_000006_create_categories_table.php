<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('categoryID');
            $table->integer('createdByUserID')->unsigned();
            $table->integer('postTypeID')->unsigned();
            $table->integer('featuredImageID')->unsigned()->nullable();
            $table->json('title');
            $table->json('description')->nullable();
            $table->json('slug');
            $table->json('customFields')->nullable();
            $table->tinyInteger('order');
            $table->json('isVisible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('categories');
    }
}
