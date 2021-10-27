<?php


namespace sam0hack\Distributor;


use Exception;
use Illuminate\Database\Eloquent\Model;

class DistributorLevel extends Model
{
    protected $guarded = [];


    public static function add_level($user_id, $code)
    {

        try {
            $dist = DistributorCode::where('referral_code', $code)->first();
            $referral_by = $dist->user_id;


        } catch (Exception $e) {

        }

    }


    /**
     * @param $user_id
     * @param $code
     * @return bool|Exception
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

			//dd($dist2_code);
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
//            $dist_6 = Distributor::where('user_id', $level_five_user)->first();
//            $dist6_code = $dist_6->code;
//            $dist_6 = DistributorCode::where('referral_code', $dist6_code)->first();
//            $level_six_user = $dist_6->user_id;

            DistributorLevel::create(['distributed_by' => $user_id, 'level_1' => $level_one_user,
                'level_2' => $level_two_user,
                'level_3' => $level_three_user,
                'level_4' => $level_four_user,
                'level_5' => $level_five_user]
            );

            return true;

        } catch (Exception $e) {
            dd($e);
            return $e;
        }
    }


    /**
     * Count all six levels users
     * @param $distributor_user_id
     * @return Exception|int
     */
    public static function totalMembersCount($distributor_user_id)
    {

        try {

            $level_one = DistributorLevelOne::GetLevelUsers($distributor_user_id) != false ? DistributorLevelOne::GetLevelUsers($distributor_user_id)->count() : 0;
            $level_two = DistributorLevelTwo::GetLevelUsers($distributor_user_id) != false ? DistributorLevelTwo::GetLevelUsers($distributor_user_id)->count() : 0;
            $level_three = DistributorLevelThree::GetLevelUsers($distributor_user_id) != false ? DistributorLevelThree::GetLevelUsers($distributor_user_id)->count() : 0;
            $level_four = DistributorLevelFour::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFour::GetLevelUsers($distributor_user_id)->count() : 0;
            $level_five = DistributorLevelFive::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFive::GetLevelUsers($distributor_user_id)->count() : 0;
            //$level_six = DistributorLevelSix::GetLevelUsers($distributor_user_id) != false ? DistributorLevelSix::GetLevelUsers($distributor_user_id)->count() : 0;

          return ($level_one + $level_two + $level_three + $level_four + $level_five);


        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * get Count of the Team members
     * @param $distributor_user_id
     * @param $level
     * @return Exception|int
     */
    public static function getCountOfTeam($distributor_user_id, $level)
    {

        try {

            switch ($level):
                case 1:

                    return DistributorLevelOne::GetLevelUsers($distributor_user_id) != false ? DistributorLevelOne::GetLevelUsers($distributor_user_id)->count() : 0;

                case 2:

                    return DistributorLevelTwo::GetLevelUsers($distributor_user_id) != false ? DistributorLevelTwo::GetLevelUsers($distributor_user_id)->count() : 0;

                case 3:

                    return DistributorLevelThree::GetLevelUsers($distributor_user_id) != false ? DistributorLevelThree::GetLevelUsers($distributor_user_id)->count() : 0;

                case 4:

                    return DistributorLevelFour::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFour::GetLevelUsers($distributor_user_id)->count() : 0;
                case 5:

                    return DistributorLevelFive::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFive::GetLevelUsers($distributor_user_id)->count() : 0;

//                case 6:
//
//                    return DistributorLevelSix::GetLevelUsers($distributor_user_id) != false ? DistributorLevelSix::GetLevelUsers($distributor_user_id)->count() : 0;
                default:
                    return 0;
            endswitch;


        } catch (Exception $e) {
            return $e;
        }
    }

    /**
     * get Level Members List
     * @param $distributor_user_id
     * @param $level
     * @return bool|Exception
     */
    public static function getLevelMembersList($distributor_user_id, $level)
    {
        try {

            switch ($level):
                case 1:

                    return DistributorLevelOne::GetLevelUsers($distributor_user_id) != false ? DistributorLevelOne::GetLevelUsers($distributor_user_id)->get() : 0;

                case 2:

                    return DistributorLevelTwo::GetLevelUsers($distributor_user_id) != false ? DistributorLevelTwo::GetLevelUsers($distributor_user_id)->get() : 0;

                case 3:

                    return DistributorLevelThree::GetLevelUsers($distributor_user_id) != false ? DistributorLevelThree::GetLevelUsers($distributor_user_id)->get() : 0;

                case 4:

                    return DistributorLevelFour::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFour::GetLevelUsers($distributor_user_id)->get() : 0;
                case 5:

                    return DistributorLevelFive::GetLevelUsers($distributor_user_id) != false ? DistributorLevelFive::GetLevelUsers($distributor_user_id)->get() : 0;

//                case 6:
//
//                    return DistributorLevelSix::GetLevelUsers($distributor_user_id) != false ? DistributorLevelSix::GetLevelUsers($distributor_user_id)->get() : 0;
                default:
                    return false;
            endswitch;


        } catch (Exception $e) {
            return $e;
        }
    }





    /**
     * get Total Earning From Level Members
     * @param $distributor_user_id
     * @param $level
     * @return bool|Exception
     */
    public static function getTotalEarningFromLevelMembers($distributor_user_id, $level)
    {
        try {

            switch ($level):
                case 1:

                    return DistributorLevelOne::GetLevelEarning($distributor_user_id) != false ? DistributorLevelOne::GetLevelEarning($distributor_user_id)->get() : 0;

                case 2:

                    return DistributorLevelTwo::GetLevelEarning($distributor_user_id) != false ? DistributorLevelTwo::GetLevelEarning($distributor_user_id)->get() : 0;

                case 3:

                    return DistributorLevelThree::GetLevelEarning($distributor_user_id) != false ? DistributorLevelThree::GetLevelEarning($distributor_user_id)->get() : 0;

                case 4:

                    return DistributorLevelFour::GetLevelEarning($distributor_user_id) != false ? DistributorLevelFour::GetLevelEarning($distributor_user_id)->get() : 0;
                case 5:

                    return DistributorLevelFive::GetLevelEarning($distributor_user_id) != false ? DistributorLevelFive::GetLevelEarning($distributor_user_id)->get() : 0;

//                case 6:
//
//                    return DistributorLevelSix::GetLevelEarning($distributor_user_id) != false ? DistributorLevelSix::GetLevelEarning($distributor_user_id)->get() : 0;
                default:
                    return false;
            endswitch;


        } catch (Exception $e) {
            return $e;
        }
    }

}
