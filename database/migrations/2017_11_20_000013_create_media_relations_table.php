<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaRelationsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('media_relations', function (Blueprint $table) {
            $table->increments('mediaRelationID');
            $table->integer('mediaID')->unsigned();
            $table->integer('belongsToID')->index();
            $table->string('belongsTo',55)->index();
            $table->json('language');
            $table->string('field',55);
            $table->timestamps();

            $table->unique(['mediaID', 'belongsToID', 'belongsTo', 'field']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media_relations');
    }
}
