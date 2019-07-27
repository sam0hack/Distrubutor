<?php


namespace sam0hack\Distributor;

use sam0hack\Distributor\DistributorCode;
use Illuminate\Database\Eloquent\Model;


class Distributor extends Model
{
    protected $guarded = [];


    /**
     * Level Maker
     * @param $user_id
     * @param $code
     */
    public static function levelMaker($user_id, $code)
    {

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


    }


    /**
     * add_distributor
     * @param $user_id
     * @param $referral_code
     * @return bool
     */
    public static function add_distributor($user_id, $referral_code)
    {
        //Default Limit
        $limit = 10;
        try {

            //skip if this user id already registered with code
            $check = Distributor::where('user_id')->first();
            if (!empty($check->id)) {
                return false;
            }

            //Get count of the current used referral codes
            $current_count = Distributor::where('code', $referral_code)->count();
            if ($current_count < $limit) {
                Distributor::create(['user_id' => $user_id, 'code' => $referral_code]);

            } else {
                // if user limit is full assign this user to another user which is in under current user
                $distributors = Distributor::where('code', $referral_code)->get();

                foreach ($distributors as $distributor):

                    $code = DistributorCode::where('user_id', $distributor->user_id)->first();
                    //$is_in_limit = self::code_count($limit,$code->referral_code);
                    $next_count = Distributor::where('code', $code->referral_code)->count();
                    if ($next_count < $limit) {
                        Distributor::create(['user_id' => $user_id, 'code' => $code->referral_code]);

                        break;
                    }
                endforeach;
                //@todo if all users limit is full add this user under to admin/Super level users

            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private static function code_count($limit, $referral_code)
    {
        $current_count = Distributor::where('code', $referral_code)->count();

        if (!empty($current_count)) {
            if ($current_count < $limit) {
                return true;
            } else {
                return false;
            }

        }
        return false;
    }



    /**
     * addUserDefaultLevels
     * @param $user_id
     * @param $code
     * @return Array|bool
     */
    public static function addUserDefaultLevels($user_id)
    {

        $count = Distributor::where('user_id', $user_id)->count();
        if ($count < 1) {
            $genZeroUsers = self::getGenZeroSixLevels();
            if ($genZeroUsers !== false) {


                Distributor::create(['user_id' => $user_id, 'code' => $genZeroUsers[0]->referral_code]);

                $above = DistributorLevel::create(['distributed_by' => $user_id,
                    'level_1' => $genZeroUsers[0]->user_id,
                    'level_2' => $genZeroUsers[1]->user_id,
                    'level_3' => $genZeroUsers[2]->user_id,
                    'level_4' => $genZeroUsers[3]->user_id,
                    'level_5' => $genZeroUsers[4]->user_id,
                    'level_6' => $genZeroUsers[5]->user_id]);

                return $above;
            }
            return false;
        } else {

            try {
                $above = DistributorLevel::where('distributed_by', $user_id)->first();
                return $above;
            } catch (\Exception $e) {
                return false;
            }

        }
    }

    /**
     * Get Generation Zero users
     * @return bool
     */
    public static function getGenZeroSixLevels()
    {

        try {
            return DistributorGenerationZeroUser::get();
        } catch (\Exception $e) {
            return false;
        }
    }


    public function getCodeUser()
    {
        $this->hasOne('Src\DistributorCode', 'referral_code', 'code');
    }

}