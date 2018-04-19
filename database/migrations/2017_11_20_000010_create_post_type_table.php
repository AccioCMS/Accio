<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTypeTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('post_type', function (Blueprint $table) {
            $table->increments('postTypeID');
            $table->integer('createdByUserID');
            $table->string('name', 55)->unique();
            $table->string('slug', 55)->unique();
            $table->json('fields')->nullable();
            $table->tinyInteger('isVisible');
            $table->tinyInteger('hasCategories');
            $table->tinyInteger('isCategoryRequired');
            $table->tinyInteger('hasTags');
            $table->tinyInteger('isTagRequired');
            $table->tinyInteger('hasFeaturedVideo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('post_type');
    }
}
