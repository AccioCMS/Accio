<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinkConfigTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('menu_link_config', function (Blueprint $table) {
            $table->increments('menuLinkConfigID');
            $table->integer('menuLinkID')->unsigned();
            $table->integer('belongsToID')->index();
            $table->string('belongsTo',55)->index();
            $table->json('postIDs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('menu_link_config');
    }
}
