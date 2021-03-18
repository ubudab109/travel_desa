<?php

use Illuminate\Database\Seeder;

class CouponPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            \DB::table('permissions')->insert(array(
                182 =>
                    array(
                        'id' => 189,
                        'name' => 'coupons.index',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
                183 =>
                    array(
                        'id' => 190,
                        'name' => 'coupons.create',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
                184 =>
                    array(
                        'id' => 191,
                        'name' => 'coupons.store',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
                185 =>
                    array(
                        'id' => 192,
                        'name' => 'coupons.edit',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
                186 =>
                    array(
                        'id' => 193,
                        'name' => 'coupons.update',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
                187 =>
                    array(
                        'id' => 194,
                        'name' => 'coupons.destroy',
                        'guard_name' => 'web',
                        'created_at' => '2020-08-23 14:58:02',
                        'updated_at' => '2020-08-23 14:58:02',
                        'deleted_at' => NULL,
                    ),
            ));

            \DB::table('role_has_permissions')->insert(array(
                255 =>
                    array(
                        'permission_id' => 189,
                        'role_id' => 2,
                    ),
                256 =>
                    array(
                        'permission_id' => 190,
                        'role_id' => 2,
                    ),
                257 =>
                    array(
                        'permission_id' => 191,
                        'role_id' => 2,
                    ),
                258 =>
                    array(
                        'permission_id' => 192,
                        'role_id' => 2,
                    ),
                259 =>
                    array(
                        'permission_id' => 193,
                        'role_id' => 2,
                    ),
                260 =>
                    array(
                        'permission_id' => 194,
                        'role_id' => 2,
                    ),
                261 =>
                    array(
                        'permission_id' => 189,
                        'role_id' => 3,
                    ),
                262 =>
                    array(
                        'permission_id' => 192,
                        'role_id' => 3,
                    ),
                263 =>
                    array(
                        'permission_id' => 193,
                        'role_id' => 3,
                    ),
                264 =>
                    array(
                        'permission_id' => 189,
                        'role_id' => 4,
                    ),
                265 =>
                    array(
                        'permission_id' => 189,
                        'role_id' => 5,
                    ),

            ));
        }catch (Exception $exception){}
    }
}
