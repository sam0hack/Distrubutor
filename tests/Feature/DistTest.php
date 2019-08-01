<?php


namespace sam0hack\Distributor\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use sam0hack\Distributor\DistributorCode;
use sam0hack\Distributor\Distributor;
use sam0hack\Distributor\DistributorGenerationZeroUser;
use sam0hack\Distributor\DistributorLevel;
use sam0hack\Distributor\DistributorSetting;
use sam0hack\Distributor\DistributorTransaction;

class DistTest extends TestCase
{
    use RefreshDatabase;

    public function testSimpleCreation()
    {


        for ($i=1;$i<=6;$i++) {
            $code = str_random(10);

            factory(DistributorGenerationZeroUser::class)->create([
                'user_id' => $i
            ]);

            factory(Distributor::class)->create([
                'user_id' => $i,
                'code'=>$code
            ]);
            factory(DistributorCode::class)->create(['user_id'=>$i,'referral_code'=>$code]);
        }

        factory(DistributorLevel::class)->create();
        $this->assertCount(6, DistributorCode::all());
        $this->assertCount(6, Distributor::all());
        $this->assertCount(1, DistributorLevel::all());

        DistributorSetting::setLimit(10);
        $limit = DistributorSetting::getLimit();
        $limit = (int)$limit;

        $this->assertEquals(10, $limit);

        DistributorSetting::setDistributionPercentage(25);
        $percentage = DistributorSetting::getPercantage();
        $percentage = (int)$percentage;
        $this->assertEquals(25, $percentage);


        $r = DistributorGenerationZeroUser::checkIfSixGenZeroUsersExists();

        $this->assertTrue($r);

        //Get a code from codes table the
        $genZeroUser = DistributorGenerationZeroUser::latest()->first();


        $code = DistributorCode::where('user_id',$genZeroUser->user_id)->first();

        $code = $code->referral_code;

        $return = Distributor::add_distributor(60, $code);

        $this->assertTrue($return);

        $level = DistributorLevel::levelMaker(60, $code);


        $this->assertTrue($level);
        $return = DistributorTransaction::distributeAmount(60,1);

        $this->assertTrue($return);

    }




}