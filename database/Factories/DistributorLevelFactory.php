<?php

use sam0hack\Distributor\DistributorLevel;

$factory->define(DistributorLevel::class, function () {
    return [
        'distributed_by' => 2,
        'level_1' => 1,
        'level_2' => 11,
        'level_3' => 12,
        'level_4' => 13,
        'level_5' => 14,
        'level_6' => 15,
    ];
});