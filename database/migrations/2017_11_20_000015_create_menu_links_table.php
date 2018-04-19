<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuLinksTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('menu_links', function (Blueprint $table) {
            $table->increments('menuLinkID');
            $table->integer('menuID')->unsigned();
            $table->integer('parent')->nullable();
            $table->integer('belongsToID')->index();
            $table->string('belongsTo',55)->index();
            $table->json('label');
            $table->string('cssClass',25)->nullable();
            $table->string('customLink',255)->nullable();
            $table->string('routeName',55)->nullable();
            $table->json('slug');
            $table->tinyInteger('order');
            $table->json('params');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('menu_links');
    }
}
