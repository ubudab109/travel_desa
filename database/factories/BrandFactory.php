<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Brand::class, function (Faker $faker) {
    return [
        'name'=>$faker->randomElement(['Adidas','Nike','Accer','Cros','Sony','Puma','Samsung']),
        'description'=>$faker->sentences(5,true),
    ];
});
