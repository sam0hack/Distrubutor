<?php

use sam0hack\Distributor\DistributorLevel;

$factory->define(DistributorLevel::class, function () {
    return [
        'distributed_by' => 200,
        'level_1' => 1,
        'level_2' => 2,
        'level_3' => 3,
        'level_4' => 4,
        'level_5' => 5,
        'level_6' => 6,
    ];
});