<?php

use Illuminate\Database\Seeder;

class SlidersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('sliders')->delete();

        \DB::table('sliders')->insert(array(
            0 =>
                array(
                    'id' => 1,
                    'description' => 'A room without books is like a body without a soul.',
                    'created_at' => '2019-08-29 22:54:23',
                    'updated_at' => '2019-10-18 12:38:04',
                ),
            1 =>
                array(
                    'id' => 2,
                    'description' => 'Be yourself, everyone else is already taken.',
                    'created_at' => '2019-08-29 22:54:23',
                    'updated_at' => '2019-10-18 12:38:04',
                ),
            2 =>
                array(
                    'id' => 3,
                    'description' => 'So many books, so little time.',
                    'created_at' => '2019-08-29 22:54:23',
                    'updated_at' => '2019-10-18 12:38:04',
                ),


        ));


    }
}
