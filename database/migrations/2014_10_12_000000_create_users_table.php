<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password', 60);

            /**
             * Account Role
             * ------------
             * 0 -> Member
             * 1 -> Moderator
             * 2 -> Admin
             * 3 -> Super Admin
             *
             */
            $table->smallInteger('role')->default(0);

            /**
             * Account Type
             * ------------
             * 0 -> Member
             * 1 -> Current Student
             * 2 -> Passout Student
             * 3 -> Faculty Member
             * 4 -> HOD
             * 5 -> Vice Principal
             * 6 -> Registrar
             * 7 -> Principal
             * 8 -> Director
             * 9 -> Guardian
             */

            /**
             * For Temp Going with:
             * 0 -> Student
             * 1 -> Faculty Member
             */
            $table->smallInteger('type')->default(0);
            $table->date('dob')->nullable();
            $table->enum('gender',['Male','Female','Others'])->nullable();
            $table->text('about')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('banned')->default(false);
            $table->rememberToken();
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
        Schema::drop('users');
    }
}
