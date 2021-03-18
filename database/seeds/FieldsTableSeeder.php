<?php

use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('fields')->delete();
        
        \DB::table('fields')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Store',
                'description' => 'Eum similique maiores atque quia explicabo. Dolores quia placeat consequatur id quis perspiciatis. Ducimus sit ducimus officia labore maiores et porro. Est iusto natus nesciunt debitis consequuntur totam. Et illo et autem inventore earum corrupti.',
                'created_at' => '2020-04-11 15:03:21',
                'updated_at' => '2020-04-11 15:03:21',
            ),
        ));
        
        
    }
}
