<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('tagID');
            $table->integer('postTypeID')->unsigned();
            $table->integer('createdByUserID')->unsigned();
            $table->integer('featuredImageID')->unsigned()->nullable();
            $table->string('title',55);
            $table->string('slug',55)->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tags');
    }
}
