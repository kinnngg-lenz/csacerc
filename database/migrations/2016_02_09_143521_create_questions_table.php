<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('question');
            $table->longText('answer')->nullable();
            $table->boolean('approved')->default(0);
            $table->boolean('public')->default(1);    // Is this Question visible to Public.
            $table->integer('user_id')->unsigned();   // Question Asker
            $table->integer('for_user_id')->unsigned()->nullable();  // To whom this Question is Raised if any.
            $table->string('slug')->unique();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('for_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('questions');
    }
}
