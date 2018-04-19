<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('media', function (Blueprint $table) {
            $table->increments('mediaID');
            $table->string('title', 255);
            $table->string('description', 255)->nullable();
            $table->string('credit', 55)->nullable();
            $table->string('type', 15);
            $table->string('extension', 5);
            $table->string('url', 255);
            $table->string('filename', 200);
            $table->string('fileDirectory', 55);
            $table->float('filesize');
            $table->string('dimensions', 11)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('media');
    }
}
