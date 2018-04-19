<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('albums', function(Blueprint $table) {
            $table->increments('albumID');
            $table->integer('createdByUserID')->unsigned();
            $table->json('title');
            $table->json('description')->nullable();
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
        Schema::drop('albums');
    }
}
