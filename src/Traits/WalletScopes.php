<?php

namespace sam0hack\Distributor\Traits;

use Exception;

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
        } catch (Exception $e) {
            return 0;
        }
    }

    /**
     * GetBalance
     * @param $user_id
     *  @param $query
     * @return mixed
     */
    public function scopeGetBalance($query, $user_id)
    {
        try {
            $q = $query->select('current_balance')->where('user_id', $user_id)->first();
            return $q->current_balance;
        }catch (Exception $e){
            return 0;
        }
    }

    /**
     * GetTotalEarning
     * @param $user_id
     *  @param $query
     * @return mixed
     */
    public function scopeGetTotalEarning($query, $user_id)
    {
        try {

            $q = $query->select('total_earned')->where('user_id', $user_id)->first();
            return $q->total_earned;
        }catch (Exception $e){
            return 0;
        }
    }


    /**
     * @param $query
     * @param $user_id
     * @param $value
     * @return int
     */
    public function scopeSetTotalEarnings($query, $user_id, $value)
    {

        try {
            $q = $query->where('user_id', $user_id)->first();
            $q->total_earned =  ( $q->total_earned + round($value,2));

            $q->save();
            return $q;
        }catch (Exception $e){
            return 0;
        }
    }


    /**
     * @param $query
     * @param $user_id
     * @param $value
     * @return int
     *
     */
    public function scopeSetTotalwithdrawal($query, $user_id, $value)
    {
        try {
            $q = $query->where('user_id', $user_id)->first();
            $q->total_withdrawal = ($q->total_withdrawal + round($value,2));
            // Update Current Balance >>>>>>>>>>>>>>>>>>>>>>>>>>>>>
            $total_earned=$q->total_earned;
            $current_balance=$total_earned-$value;
            $q->current_balance=$current_balance;
            $q->save();
            return $q;
        }catch (Exception $e){
            return 0;
        }
    }


    /**
     * @param $query
     * @param $user_id
     * @param $value
     * @return int
     */
    public function scopeSetBalance($query, $user_id, $value)
    {
        try{
        $q = $query->where('user_id', $user_id)->first();
        $q->current_balance = ( $q->current_balance +  round($value,2));
        $q->save();
        return $q;
        }catch (Exception $e){
            return 0;
        }
    }


    public function scopeAddEarning($query,$user_id,$value){

        try{

            $this->scopeSetBalance($query,$user_id,$value);
            $this->scopeSetTotalEarnings($query,$user_id,$value);

        }catch (Exeption $e){
            return 0;
        }

    }

}
