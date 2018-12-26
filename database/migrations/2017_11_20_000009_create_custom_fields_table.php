<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->increments('customFieldID');
            $table->integer('customFieldGroupID')->unsigned();
            $table->integer('parentID')->unsigned()->nullable();
            $table->json('label')->nullable();
            $table->string('slug',55)->unique();
            $table->json('placeholder')->nullable();
            $table->string('type',20);
            $table->json('note')->nullable();
            $table->string('defaultValue',155)->nullable();
            $table->text('optionsValues')->nullable();
            $table->json('conditions')->nullable();
            $table->tinyInteger('order');
            $table->tinyInteger('isRequired');
            $table->tinyInteger('isTranslatable');
            $table->tinyInteger('isMultiple');
            $table->tinyInteger('isActive');
            $table->json('wrapperStyle')->nullable();
            $table->json('fieldStyle')->nullable();
            $table->json('properties')->nullable();
            $table->string('layout',10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('custom_fields');
    }
}
