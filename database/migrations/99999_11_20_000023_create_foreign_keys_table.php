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
        // Albums
        Schema::table('albums', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Album relations
        Schema::table('album_relations', function (Blueprint $table) {
            $table->foreign('albumID')->references('albumID')->on('albums');
            $table->foreign('mediaID')->references('mediaID')->on('media');
        });

        // Category
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
            $table->foreign('featuredImageID')->references('mediaID')->on('media');
        });

        // Category relations
        Schema::table('categories_relations', function (Blueprint $table) {
            $table->foreign('categoryID')->references('categoryID')->on('categories');
        });

        // Custom fields
        Schema::table('custom_fields', function (Blueprint $table) {
            $table->foreign('customFieldGroupID')->references('customFieldGroupID')->on('custom_fields_groups');
        });

        // Media relations
        Schema::table('media', function (Blueprint $table){
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        Schema::table('media_relations', function (Blueprint $table){
            $table->foreign('mediaID')->references('mediaID')->on('media');
        });

        // Menulinks
        Schema::table('menu_links', function (Blueprint $table) {
            $table->foreign('menuID')->references('menuID')->on('menus');
        });

        // Menu link config
        Schema::table('menu_link_config', function (Blueprint $table) {
            $table->foreign('menuLinkID')->references('menuLinkID')->on('menu_links');
        });

        // Permissions
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('groupID')->references('groupID')->on('users_groups');
        });

        // Post types
        Schema::table('post_type', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Languages
        Schema::table('languages', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });

        // Tags
        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
            $table->foreign('createdByUserID')->references('userID')->on('users');
            $table->foreign('featuredImageID')->references('mediaID')->on('media');
        });

        // Tags relations
        Schema::table('tags_relations', function (Blueprint $table) {
            $table->foreign('tagID')->references('tagID')->on('tags');
        });

        // Roles     relations
        Schema::table('roles_relations', function (Blueprint $table) {
            $table->foreign('userID')->references('userID')->on('users');
            $table->foreign('groupID')->references('groupID')->on('users_groups');
        });

        // Users
        Schema::table('users', function(Blueprint $table) {
            $table->foreign('profileImageID')->references('mediaID')->on('media');
            $table->foreign('createdByUserID')->references('userID')->on('users');
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
