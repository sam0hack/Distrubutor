<?php


namespace sam0hack\Distributor;

use Illuminate\Database\Eloquent\Model;
use sam0hack\Distributor\Traits\LevelScopes;

class DistributorLevelOne extends Model
{
    protected $guarded = [];
    protected $table = 'distributor_level_one';
    use LevelScopes;

    public static function getLevelOneEarnings($user_id)
    {
        $level_earning_array = [];
        $level_one = DistributorLevelOne::GetLevelUsers($user_id) != false ? DistributorLevelOne::GetLevelUsers($user_id)->select('level_user_id')->get()->toArray() : 0;

        if ($level_one != false OR $level_one != 0) {
            $sum = 0;
            foreach ($level_one as $level_one_earn) {
                $level_one_earn = $level_one_earn['level_user_id'];
                $earning = DistributorWallet::GetTotalEarning($level_one_earn);
                array_push($level_earning_array, ['user_id' => $level_one_earn, 'earned' => $earning]);
                $sum = ($sum + $earning);
            }

            array_push($level_earning_array, ['total_earned' => $sum]);
            return $level_earning_array;

        }

    }

}
