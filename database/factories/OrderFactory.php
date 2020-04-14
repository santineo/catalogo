<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {

    return [
      'name' => $faker->name,
      'email' => $faker->unique()->safeEmail,
      'phone' => $faker->phoneNumber,
      'address' => $faker->address,
      'additional_info' => $faker->text,
      'status' => rand(1,3)
    ];
});
