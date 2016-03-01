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
            $table->text('speech')->nullable();
            $table->string('speaker');
            $table->string('batch');
            $table->string('profession');
            $table->integer('organisation_id')->nullable()->unsigned();
            $table->integer('photo_id')->nullable()->unsigned();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('slug')->unique();
            $table->integer('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('photo_id')->references('id')->on('photos');
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
