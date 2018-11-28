<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermalinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('permalinks', function (Blueprint $table) {
            $table->increments('permalinkID');
            $table->string('belongsTo',55)->index();
            $table->string('name',55);
            $table->string('custom_url',255)->nullable();
            $table->string('default_url',255)->nullable();
            $table->string('acceptedParameters',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('permalinks');
    }
}
