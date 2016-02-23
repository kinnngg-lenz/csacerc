<?php

use Illuminate\Database\Seeder;

class CollegeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('colleges')->delete();

        DB::table('colleges')->insert(array(
            array('id' => '1','name'=>'ARYA College of Engg. & Research Center','initials'=>'ACERC'),
            array('id' => '2','name'=>'ARYA Institute of Engg. & Technology','initials'=>'AIET'),
            array('id' => '3','name'=>'ARYA Institute of Engg. Tech & Management','initials'=>'AIETM'),
            array('id' => '4','name'=>'ARYA College of Pharmacy','initials'=>'ACP'),
            array('id' => '5','name'=>'Others','initials'=>'O'),
            array('id' => '6','name'=>'None','initials'=>'N'),
        ));
    }
}
