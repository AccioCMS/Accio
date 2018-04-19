<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('users', function(Blueprint $table){
            $table->increments('userID');
            $table->integer('profileImageID')->nullable();
            $table->json('groupIDs')->nullable();
            $table->string('email', 155)->unique();
            $table->string('password',255);
            $table->string('firstName',100)->nullable();
            $table->string('lastName',100)->nullable();
            $table->string('slug',200);
            $table->string('gravatar',255)->nullable();
            $table->string('phone',25)->nullable();
            $table->json('about');
            $table->string('street',155)->nullable();
            $table->string('country',55)->nullable();
            $table->tinyInteger('isActive');
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::drop('users');
    }
}
