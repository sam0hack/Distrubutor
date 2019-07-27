<?php

use sam0hack\Distributor\DistributorAmount;

$factory->define(DistributorAmount::class, function (Faker\Generator $faker) {

    $amount = $faker->randomFloat();
    $dist_percent = 2;

    $dist_amount = ($dist_percent / 100) * $amount;
    $per_user_amount = ($dist_amount/6);
    $per_user_amount = round($per_user_amount);
    return [
        'level_id' => 1,
        'total_amount' => $amount,
        'dist_percent' => $dist_percent,
        'dist_amount' => $dist_amount,
        'per_user_amount' =>$per_user_amount,

    ];
});