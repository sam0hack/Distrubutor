<?php


namespace sam0hack\Distributor;

use Exception;
use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\WalletScopes;

/**
 * Class DistributorWallet
 * @package sam0hack\Distributor
 */
class DistributorWallet extends Model
{
    use WalletScopes;
    protected $guarded = [];

    public static function createWalletIfNotExists($user_id)
    {
        try {
            $wallet = DistributorWallet::where('user_id', $user_id)->first();
            if ($wallet === null) {
                //Create
                DistributorWallet::create(['user_id' => $user_id, 'total_earned' => 0, 'total_withdrawal' => 0, 'current_balance' => 0]);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }

    }

}
