<?php


namespace sam0hack\Distributor;


use Illuminate\Database\Eloquent\Model;

class DistributorLevel extends Model
{
    protected $guarded = [];

    /**
     * @param $user_id
     * @param $code
     * @return bool|\Exception
     */
    public static function levelMaker($user_id, $code)
    {

        try {
            //Get owner of the this referral $code
            $dist_1 = DistributorCode::where('referral_code', $code)->first();
            $level_one_user = $dist_1->user_id;

            //Get Second level
            $dist_2 = Distributor::where('user_id', $level_one_user)->first();
            $dist2_code = $dist_2->code;

            $dist_2 = DistributorCode::where('referral_code', $dist2_code)->first();
            $level_two_user = $dist_2->user_id;


            //Get the 3rd level
            $dist_3 = Distributor::where('user_id', $level_two_user)->first();
            $dist3_code = $dist_3->code;

            $dist_3 = DistributorCode::where('referral_code', $dist3_code)->first();
            $level_three_user = $dist_3->user_id;

            //Get the 4th level
            $dist_4 = Distributor::where('user_id', $level_three_user)->first();
            $dist4_code = $dist_4->code;
            $dist_4 = DistributorCode::where('referral_code', $dist4_code)->first();
            $level_four_user = $dist_4->user_id;

            //Get the 5th level
            $dist_5 = Distributor::where('user_id', $level_four_user)->first();
            $dist5_code = $dist_5->code;
            $dist_5 = DistributorCode::where('referral_code', $dist5_code)->first();
            $level_five_user = $dist_5->user_id;


            //Get the 6th level
            $dist_6 = Distributor::where('user_id', $level_five_user)->first();
            $dist6_code = $dist_6->code;
            $dist_6 = DistributorCode::where('referral_code', $dist6_code)->first();
            $level_six_user = $dist_6->user_id;

            DistributorLevel::create(['distributed_by' => $user_id, 'level_1' => $level_one_user,
                'level_2' => $level_two_user,
                'level_3' => $level_three_user,
                'level_4' => $level_four_user,
                'level_5' => $level_five_user,
                'level_6' => $level_six_user]);

            return true;

        } catch (\Exception $e) {
            return $e;
        }
    }
}