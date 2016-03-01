<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('initials')->nullable();
            $table->text('details')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('slug');

            $table->foreign('photo_id')->references('id')->on('photos');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('organisations');
    }
}
