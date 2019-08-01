<?php

use sam0hack\Distributor\Distributor;

$factory->define(Distributor::class, function ($user_id,$code) {
    return [
        'user_id' => $user_id,
        'code' => $code,
    ];
});