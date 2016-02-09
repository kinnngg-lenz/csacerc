<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            /**
             * Type:
             * 0 -> Local News
             * 1 -> Tech News
             * 2 -> Hot on Net
             * 3 -> News of the Day
             */
            $table->smallInteger('type')->default(0);
            $table->integer('photo_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('photo_id')->references('id')->on('photos');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news');
    }
}
