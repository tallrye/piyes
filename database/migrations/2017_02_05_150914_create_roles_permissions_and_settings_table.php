<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesPermissionsAndSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->boolean('isLocked')->default(false);
            $table->boolean('isSidebarClosed')->default(false);
            $table->boolean('showNotifications')->default(true);
            $table->string('language')->default('en');
            $table->string('profile_photo')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->nullableTimestamps();
            
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();

            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->primary(['role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
        Schema::drop('permission_role');
        Schema::drop('roles');
        Schema::drop('permissions');
        Schema::drop('user_settings');
        Schema::drop('loginlogs');
    }
}
