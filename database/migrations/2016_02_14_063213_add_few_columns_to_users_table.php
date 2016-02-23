<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->integer('department_id')->unsigned()->default(1)->after('type');
            $table->integer('college_id')->unsigned()->default(1)->after('type');

            /**
             * Exp Point of User
             */
            $table->integer('xp')->default(0)->after('banned');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('xp');
            $table->dropColumn('department_id');
            $table->dropColumn('college_id');
        });
    }
}
