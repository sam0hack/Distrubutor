<?php

use sam0hack\Distributor\Distributor;

$factory->define(Distributor::class, function () {
    return [
        'user_id' => 2,
        'code' => 'simple_code1',
    ];
});