<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
//        Schema::create('roles_relations', function (Blueprint $table) {
//            $table->increments('roleRelationID');
//            $table->integer('userID')->unsigned();
//            $table->integer('groupID')->unsigned();
//            $table->unique(['userID', 'groupID']);
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('roles_relations');
    }
}
