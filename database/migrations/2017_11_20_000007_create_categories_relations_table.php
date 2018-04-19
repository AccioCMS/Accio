<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesRelationsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('categories_relations', function (Blueprint $table) {
            $table->increments('categoryRelationID');
            $table->integer('categoryID')->unsigned();
            $table->integer('belongsToID')->index();
            $table->string('belongsTo',55)->index();
            $table->timestamps();

            $table->unique(['categoryID', 'belongsToID', 'belongsTo']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('categories_relations');
    }
}
