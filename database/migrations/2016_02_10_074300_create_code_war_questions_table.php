<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCodeWarQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('code_war_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('slug');
            $table->integer('best_answer_id')->nullable()->unsigned();
            $table->timestamp('ends_at')->nullable();

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
        Schema::drop('code_war_questions');
    }
}
