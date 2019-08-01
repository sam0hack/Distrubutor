<?php


namespace sam0hack\Distributor;


use Illuminate\Database\Eloquent\Model;


class DistributorEarningFromUser extends Model
{
    protected $guarded = [];

    /**
     * Earned
     * @param $user_id
     * @param $amount_id
     * @param $earned
     * @return bool
     */
    public static function earned($user_id, $transaction_id, $earned)
    {

        try {
            $earned = (float)$earned;
            DistributorEarnedFrom::create(['user_id' => $user_id, 'transaction_id' => $transaction_id,
                'earned' => $earned]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}