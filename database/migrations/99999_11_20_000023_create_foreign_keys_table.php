<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        // Users
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('profileImageID')->references('mediaID')->on('media')->onDelete('set null');
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Category
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
            $table->foreign('featuredImageID')->references('mediaID')->on('media')->onDelete('set null');
        });

        // Media
        Schema::table('media', function (Blueprint $table){
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Custom fields
        Schema::table('custom_fields', function (Blueprint $table) {
            $table->foreign('customFieldGroupID')->references('customFieldGroupID')->on('custom_fields_groups');
            $table->foreign('parentID')->references('customFieldID')->on('custom_fields');
        });

        // Post types
        Schema::table('post_type', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Languages
        Schema::table('languages', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Menulinks
        Schema::table('menu_links', function (Blueprint $table) {
            $table->foreign('menuID')->references('menuID')->on('menus');
            $table->foreign('parent')->references('menuLinkID')->on('menu_links');
        });

        // Permissions
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('groupID')->references('groupID')->on('users_groups');
            $table->unique(['groupID', 'app', 'key']);
        });

        // Tags
        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
            $table->foreign('createdByUserID')->references('userID')->on('users');
            $table->foreign('featuredImageID')->references('mediaID')->on('media')->onDelete('set null');
        });

        // Roles     relations
        Schema::table('roles_relations', function (Blueprint $table) {
            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('groupID')->references('groupID')->on('users_groups');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

    }
}
