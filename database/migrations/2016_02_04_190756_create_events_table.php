<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->date('date');
            $table->text('description');
            $table->string('venue')->nullable();
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
        Schema::drop('events');
    }
}
