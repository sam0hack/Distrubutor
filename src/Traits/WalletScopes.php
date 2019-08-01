<?php

namespace sam0hack\Distributor\Traits;

/**
 * Trait WalletScopes
 * @package sam0hack\Distributor\Traits
 */
trait WalletScopes
{

    /**
     * GetTotalWithdrawal of the user
     * @param $query
     * @param $user_id
     * @return mixed
     */
    public function scopeGetTotalwithdrawal($query, $user_id)
    {

        try {
            $q = $query->select('total_withdrawal')->where('user_id', $user_id)->first();
            return $q->total_withdrawal;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * GetBalance
     * @param $user_id
     * @return mixed
     */
    public function scopeGetBalance($query, $user_id)
    {
        try {
            $q = $query->select('current_balance')->where('user_id', $user_id)->first();
            return $q->current_balance;
        }catch (\Exception $e){
            return 0;
        }
    }

    /**
     * GetTotalEarning
     * @param $user_id
     * @return mixed
     */
    public function scopeGetTotalEarning($query, $user_id)
    {
        try {

            $q = $query->select('total_earned')->where('user_id', $user_id)->first();
            return $q->total_earned;
        }catch (\Exception $e){
            return 0;
        }
    }

    /**
     * @param $query
     * @param $user_id
     * @param $value
     */
    public function scopeSetTotalEarnings($query, $user_id, $value)
    {

        try {
            $q = $query->where('user_id', $user_id)->first();
            $q->total_earned = round($value,2);
            $q->save();
            return $q;
        }catch (\Exception $e){
            return 0;
        }
    }

    /**
     * @param $query
     * @param $user_id
     * @param $value
     */
    public function scopeSetTotalwithdrawal($query, $user_id, $value)
    {
        try {
            $q = $query->where('user_id', $user_id)->first();
            $q->total_withdrawal = round($value,2);
            $q->save();
            return $q;
        }catch (\Exception $e){
            return 0;
        }
    }

    /**
     * @param $query
     * @param $user_id
     * @param $value
     */
    public function scopeSetBalance($query, $user_id, $value)
    {
        try{
        $q = $query->where('user_id', $user_id)->first();
        $q->current_balance = round($value,2);
        $q->save();
        return $q;
        }catch (\Exception $e){
            return 0;
        }
    }
}