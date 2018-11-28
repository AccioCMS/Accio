<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('languageID');
            $table->integer('createdByUserID')->unsigned();
            $table->string('name',30);
            $table->string('nativeName',45);
            $table->string('slug',5)->unique();
            $table->tinyInteger('isDefault');
            $table->tinyInteger('isVisible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('languages');
    }
}
