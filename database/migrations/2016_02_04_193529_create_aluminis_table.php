<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAluminisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluminis', function (Blueprint $table) {
            $table->increments('id');
            $table->text('speech');
            $table->string('speaker');
            $table->string('batch');
            $table->string('profession');

            $table->integer('user_id')->unsigned();
            $table->string('slug')->unique();
            $table->timestamps();
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
        Schema::drop('aluminis');
    }
}
