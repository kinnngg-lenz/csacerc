<?php

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->delete();

        DB::table('departments')->insert(array(
            array('id' => '1','name'=>'Computer Science Engineering','initials'=>'CSE'),
            array('id' => '2','name'=>'First Year','initials'=>'1Yr'),
            array('id' => '3','name'=>'Civil Engineering','initials'=>'CE'),
            array('id' => '4','name'=>'Electrical Engineering','initials'=>'EE'),
            array('id' => '5','name'=>'Mechanical Engineering','initials'=>'ME'),
            array('id' => '6','name'=>'Electronics & Communication Engineering','initials'=>'ECE'),
            array('id' => '7','name'=>'Information Technology','initials'=>'IT'),
            array('id' => '8','name'=>'Others','initials'=>'O'),
            array('id' => '9','name'=>'None','initials'=>'N'),
            ));
    }
}
