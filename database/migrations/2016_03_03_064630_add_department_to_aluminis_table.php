<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentToAluminisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('aluminis', function (Blueprint $table) {
            $table->integer('department_id')->unsigned()->nullable()->after('batch');

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('aluminis', function (Blueprint $table) {
            $table->dropForeign('aluminis_department_id_foreign');
            $table->dropColumn('department_id');
        });
    }
}
