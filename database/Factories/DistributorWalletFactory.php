<?php

use Faker\Generator;
use sam0hack\Distributor\DistributorWallet;

$factory->define(DistributorWallet::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 200,
        'total_earned'=>$faker->randomFloat(),
        'total_withdrawal'=>$faker->randomFloat(),
         'current_balance'=>$faker->randomFloat()
    ];
});