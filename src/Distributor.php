<?php


namespace sam0hack\Distributor;

use sam0hack\Distributor\DistributorCode;
use Illuminate\Database\Eloquent\Model;


class Distributor extends Model
{
    protected $guarded = [];


    /**
     * add_distributor
     * @param $user_id
     * @param $referral_code
     * @return bool
     */
    public static function add_distributor($user_id, $referral_code)
    {
        // Limit from Settings Table

        $limit = DistributorSetting::getLimit();
        try {

            //skip if this user id already registered with code
            $check = Distributor::where('user_id', $user_id)->first();
            if (!empty($check->id)) {
                return false;
            }

            //Get count of the current used referral codes
            $current_count = Distributor::where('code', $referral_code)->count();
            if ($current_count < $limit) {
                Distributor::create(['user_id' => $user_id, 'code' => $referral_code]);
                DistributorLevel::levelMaker($user_id, $referral_code);
                DistributorCode::createUserCode($user_id);

            } else {
                // if user limit is full assign this user to another user which is in under current user
                $distributors = Distributor::where('code', $referral_code)->get();

                foreach ($distributors as $distributor):

                    $code = DistributorCode::where('user_id', $distributor->user_id)->first();
                    //$is_in_limit = self::code_count($limit,$code->referral_code);
                    $next_count = Distributor::where('code', $code->referral_code)->count();
                    if ($next_count < $limit) {
                        Distributor::create(['user_id' => $user_id, 'code' => $code->referral_code]);
                        DistributorLevel::levelMaker($user_id, $code->referral_code);
                        DistributorCode::createUserCode($user_id);
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
     * Check if user exits
     * @param $user_id
     * @return bool
     */
    public static function checkIfUserLevelExists($user_id)
    {

        $exists = DistributorLevel::where('distributed_by', $user_id)->first();

        if ($exists === null) {
            return false;
        } else {
            return true;
        }

    }


    public static function getRandomGenZeroCode()
    {
        try {
            $r = rand(1, 6);
            $code = DistributorCode::where('user_id', $r)->first();
            return $code->referral_code;
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * get User code
     * @param $user_id
     * @return \Exception
     */
    public static function getCode($user_id)
    {

        try {
            $code = DistributorCode::where('user_id', $user_id)->first();
            return $code->referral_code;
        } catch (\Exception $e) {
            return $e;
        }

    }

    public function getCodeUser()
    {
        $this->hasOne('Src\DistributorCode', 'referral_code', 'code');
    }

}