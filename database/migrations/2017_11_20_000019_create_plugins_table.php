<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePluginsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('plugins', function (Blueprint $table) {
            $table->increments('pluginID');
            $table->string('title',155);
            $table->string('namespace',100);
            $table->string('author',100);
            $table->string('version',10);
            $table->tinyInteger('isActive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('plugins');
    }
}
