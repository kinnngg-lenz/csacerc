<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeWarAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_war_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('answer');
            $table->integer('user_id')->unsigned();
            $table->integer('code_war_question_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('code_war_question_id')->references('id')->on('code_war_questions')->onDelete('cascade');
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
        Schema::drop('code_war_answers');
    }
}
