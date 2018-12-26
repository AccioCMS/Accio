<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('permissionID');
            $table->integer('groupID')->unsigned();
            $table->string('app',55);
            $table->string('key',55);
            $table->tinyInteger('value');
            $table->json('ids')->nullable();
            $table->tinyInteger('hasAll')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('permissions');
    }
}
