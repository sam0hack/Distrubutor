<?php

use sam0hack\Distributor\DistributorGenerationZeroUser;

$factory->define(DistributorGenerationZeroUser::class, function ($user_id) {
    return [
        'user_id' => $user_id,
    ];
});