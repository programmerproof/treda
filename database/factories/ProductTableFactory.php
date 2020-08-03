<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        //
        'sku' => $faker->unique()->swiftBicNumber(),
        'name' => $faker->unique()->firstNameMale(),
        'description' => $faker->unique()->realText($maxNbChars = 50, $indexSize = 2),
        'value' => $faker->unique()->ean8(),
        'image' => $faker->imageUrl($width = 60, $height = 48, 'cats'),
        'created_at' => date("Y-m-d H:i:s", time())
    ];
});
