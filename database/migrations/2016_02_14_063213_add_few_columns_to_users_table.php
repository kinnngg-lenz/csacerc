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

            /**
             * 0 -> None
             * 1 -> CS
             * 2 -> EE
             * 3 -> CE
             */
            $table->integer('department')->default(0)->after('type');

            /**
             * College Belongs to
             * 0 -> None
             * 1 -> ACERC
             * 2 -> AIET
             * 3 -> AIETM
             * 4 -> Arya College of Pharmacy
             * 5 -> Arya Old
             * 6 -> Others
             */
            $table->integer('college')->default(0)->after('type');

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
            $table->dropColumn('department');
            $table->dropColumn('college');
        });
    }
}
