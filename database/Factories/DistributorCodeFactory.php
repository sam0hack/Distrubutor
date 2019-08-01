<?php

use sam0hack\Distributor\DistributorCode;

$factory->define(DistributorCode::class, function ($user_id,$referral_code) {
    return [
        'user_id' => $user_id,
        'referral_code' => $referral_code,
    ];
});