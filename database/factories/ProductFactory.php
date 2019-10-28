<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
  $category = factory('App\Category')->create();
  $brand = factory('App\Brand')->create();
    return [
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'price' => $faker->randomFloat(2, 0, 10000),
        'published' => 0,
        'category_id' => $category->id,
        'brand_id' => $brand->id,
    ];
});
