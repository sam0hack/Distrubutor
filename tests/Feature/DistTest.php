<?php


namespace sam0hack\Distributor\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use sam0hack\Distributor\DistributorAmount;
use sam0hack\Distributor\DistributorCode;
use sam0hack\Distributor\Distributor;
use sam0hack\Distributor\DistributorLevel;

class DistTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateDistributor()
    {
        factory(DistributorCode::class)->create();
        factory(Distributor::class)->create();
        factory(DistributorLevel::class)->create();
        factory(DistributorAmount::class)->create();
        $this->assertCount(1, DistributorCode::all());
        $this->assertCount(1, Distributor::all());
        $this->assertCount(1, DistributorLevel::all());
        $this->assertCount(1, DistributorAmount::all());

    }

    public function testMultipleDistributors()
    {

        for ($i = 3; $i < 100; $i++) {
            $d = DistributorCode::createUserCode($i);

            if ($d != false) {

            } else {
                $this->assertTrue(false);
            }

            $c = Distributor::add_distributor($i, 'simple_code1');
            $this->assertTrue(true);

        }
    }

}