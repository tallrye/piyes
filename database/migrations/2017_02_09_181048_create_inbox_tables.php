<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('to');
            $table->string('cc')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });


        // Can Be Multilingual
        Schema::create('form_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->string('to');
            $table->string('cc')->nullable();
            $table->integer('contact_form_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('contact_form_id')->references('id')->on('contact_forms');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });


        Schema::create('inbox_mails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_form_id')->unsigned()->nullable();
            $table->integer('form_category_id')->unsigned()->nullable();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('subject')->nullable();
            $table->text('body');
            $table->boolean('isRead')->default(false);
            $table->boolean('isSent')->default(false);
            $table->boolean('isDraft')->default(false);
            $table->boolean('isTrash')->default(false);
            $table->boolean('isImportant')->default(false);
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('contact_form_id')->references('id')->on('contact_forms');
            $table->foreign('form_category_id')->references('id')->on('form_categories');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });

        Schema::create('inbox_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inbox_mail_id')->unsigned();
            $table->string('path');
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('inbox_mail_id')->references('id')->on('inbox_mails');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inbox_attachments');
        Schema::drop('inbox_mails');
        Schema::drop('form_categories');
        Schema::drop('contact_forms');
    }
}
