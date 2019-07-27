<?php

use sam0hack\Distributor\DistributorCode;

$factory->define(DistributorCode::class, function (Faker\Generator $faker) {
    return [
        'user_id' => 1,
        'referral_code' => 'simple_code1',
    ];
});