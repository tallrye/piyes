<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_materials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_id')->unsigned();
            $table->string('title')->nullable();
            $table->string('main_file')->nullable();
            $table->boolean('publish')->default(false);
            $table->integer('position')->default(1);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->nullableTimestamps();

            $table->foreign('article_id')->references('id')->on('articles');
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
        Schema::drop('article_materials');
    }
}
