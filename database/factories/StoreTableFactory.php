<?php

use Faker\Generator as Faker;

$factory->define(App\Store::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->unique()->company(),
        'opening_date' => $faker->unique()->date($format = 'Y-m-d', $max = 'now'),
        'created_at' => date("Y-m-d H:i:s", time())
    ];
});
