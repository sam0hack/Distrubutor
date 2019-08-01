<?php


namespace sam0hack\Distributor\Tests\Feature;


use sam0hack\Distributor\DistributorLevel;
use sam0hack\Distributor\Tests;

class InitialTest extends Tests\TestCase
{

    public function test_test(){

        $level = DistributorLevel::levelMaker(60, 'Qa7styAsRA');
        dd($level);
    }
}