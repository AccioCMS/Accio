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
        Schema::table('albums', function(Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });
        Schema::table('album_relations', function (Blueprint $table) {
            $table->foreign('albumID')->references('albumID')->on('albums');
            $table->foreign('mediaID')->references('mediaID')->on('media');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('createdByUserID')->references('userID')->on('users');
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
        });
        Schema::table('categories_relations', function (Blueprint $table) {
            $table->foreign('categoryID')->references('categoryID')->on('categories');
        });
        Schema::table('custom_fields', function (Blueprint $table) {
            $table->foreign('customFieldGroupID')->references('customFieldGroupID')->on('custom_fields_groups');
        });
        Schema::table('media_relations', function (Blueprint $table) {
            $table->foreign('mediaID')->references('mediaID')->on('media');
        });
        Schema::table('menu_links', function (Blueprint $table) {
            $table->foreign('menuID')->references('menuID')->on('menus');
        });
        Schema::table('menu_link_config', function (Blueprint $table) {
            $table->foreign('menuLinkID')->references('menuLinkID')->on('menu_links');
        });
        Schema::table('permissions', function (Blueprint $table) {
            $table->foreign('groupID')->references('groupID')->on('users_groups');
        });
        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('postTypeID')->references('postTypeID')->on('post_type');
            $table->foreign('createdByUserID')->references('userID')->on('users');
        });
        Schema::table('tags_relations', function (Blueprint $table) {
            $table->foreign('tagID')->references('tagID')->on('tags');
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
