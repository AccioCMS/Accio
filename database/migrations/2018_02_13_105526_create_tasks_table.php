<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('taskID');
            $table->string('belongsTo',55)->index();
            $table->string('type',50);
            $table->json('data');
            $table->json('additional');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        Schema::dropIfExists('tasks');
    }
}
