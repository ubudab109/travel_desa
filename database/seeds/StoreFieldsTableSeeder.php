<?php

use Illuminate\Database\Seeder;

class StoreFieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('store_fields')->delete();
        \DB::table('store_fields')->insert(
            [
                array(
                    'store_id' => 1,
                    'field_id' => 1,
                ),
                /* array(
                     'store_id' => 1,
                     'field_id' => 4,
                 ),
                 array(
                     'store_id' => 3,
                     'field_id' => 4,
                 ),
                 array(
                     'store_id' => 2,
                     'field_id' => 3,
                 ),
                 array(
                     'store_id' => 5,
                     'field_id' => 6,
                 ),
                 array(
                     'store_id' => 2,
                     'field_id' => 2,
                 ),
                 array(
                     'store_id' => 6,
                     'field_id' => 3,
                 ),
                 array(
                     'store_id' => 7,
                     'field_id' => 1,
                 ),
                 array(
                     'store_id' => 8,
                     'field_id' => 5,
                 ),
                 array(
                     'store_id' => 7,
                     'field_id' => 2,
                 ),
                 array(
                     'store_id' => 9,
                     'field_id' => 1,
                 ),

                 array(
                     'store_id' => 10,
                     'field_id' => 5,
                 )*/
            ]
        );
    }
}
