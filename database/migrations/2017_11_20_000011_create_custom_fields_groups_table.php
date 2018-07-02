<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomFieldsGroupsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('custom_fields_groups', function (Blueprint $table) {
            $table->increments('customFieldGroupID');
            $table->string('title',155);
            $table->string('slug',155);
            $table->string('description',255)->nullable();
            $table->tinyInteger('isActive')->index();
            $table->json('conditions');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('custom_fields_groups');
    }
}
