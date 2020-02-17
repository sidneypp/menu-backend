<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enumerators\OrderStatus;
use App\Models\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'status' => $faker->randomElement([OrderStatus::PENDING, OrderStatus::DELIVERED, OrderStatus::NEW]),
        'value' => $faker->randomNumber(),
    ];
});
