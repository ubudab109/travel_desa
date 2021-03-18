<?php
/**
 * File name: StoreFactory.php
 * Last modified: 2020.04.20 at 18:08:03
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 *
 */

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    return [
    'name' => $faker->name,
    'description' => $faker->text,
    'phone' => $faker->phoneNumber,
    'mobile' => $faker->phoneNumber,
    'information' => $faker->sentences(3,true),
    'admin_commission' => $faker->randomFloat(2,10,50),
    'delivery_fee' => $faker->randomFloat(2,1,10),
    'delivery_range' => $faker->randomFloat(2,5,100),
    'default_tax' => $faker->randomFloat(2,5,30), //added
    'closed' => $faker->boolean,
    'available_for_delivery' => $faker->boolean,
    //'active' => $faker->boolean,//added
    ];
});
