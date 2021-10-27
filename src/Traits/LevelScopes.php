<?php

namespace sam0hack\Distributor\Traits;

use Mockery\Exception;
use sam0hack\Distributor\DistributorSetting;

/**
 * Trait LevelScopes
 * @package sam0hack\Distributor\Traits
 */
trait LevelScopes
{

    /**
     * CheckForDuplicate in the Table
     * @param $query
     * @param $user_id
     * @param $referral_id
     * @return mixed
     */
    public function scopeCheckForDuplicate($query, $referral_id, $user_id)
    {


        $q = $query->select('id')->where('user_id', $referral_id)->where('level_user_id', $user_id)->count();


        if ($q < 1) {
            return true;
        } else {
            return false;
        }


    }

    /**
     * LimitCheckLevelOne
     * @param $query
     * @param $referral_id
     * @return bool
     */
    public function scopeLimitCheckLevelOne($query, $referral_id)
    {
        $limit = DistributorSetting::getLimit();

        $q = $query->select('id')->where('user_id', $referral_id)->count();
        if ($q < 1) {
            return true;
        } elseif ($q <= $limit) {
            return true;
        } else {

            return false;
        }

    }


    public function scopeGetLevelUsers($query, $user)
    {

        try {
            $q = $query->where('user_id', $user);

            if (empty($q)) {
                return false;
            }
            return $q;
        } catch (Exception $e) {
            return false;
        }
    }


}
