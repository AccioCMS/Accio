<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsRelationsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tags_relations', function (Blueprint $table) {
            $table->increments('tagRelationID');
            $table->integer('tagID')->unsigned();
            $table->integer('belongsToID')->index();
            $table->string('belongsTo',55)->index();
            $table->string('language',5);
            $table->timestamps();

            $table->unique(['tagID', 'belongsToID', 'belongsTo', 'language']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tags_relations');
    }
}
