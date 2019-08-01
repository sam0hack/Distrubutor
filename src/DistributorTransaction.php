<?php


namespace sam0hack\Distributor;

use sam0hack\Distributor\DistributorWallet;
use Illuminate\Database\Eloquent\Model;


class DistributorTransaction extends Model
{
    protected $guarded = [];


    /**
     * @param $distributor_id
     * @param $amount
     * @return bool
     */
    public static function distributeAmount($distributor_id, $amount)
    {
        try {
            //get this user's 6 levels
            $distributor = DistributorLevel::where('distributed_by', $distributor_id)->first();

            if ($distributor === null) {
                return $distributor;
            }

            $level_one = $distributor->level_1;
            $level_two = $distributor->level_2;
            $level_three = $distributor->level_3;
            $level_four = $distributor->level_4;
            $level_five = $distributor->level_5;
            $level_six = $distributor->level_6;

            //Get Percantage of the Ammount
            $percentage = DistributorSetting::getPercantage();

            $percentage_dist = ($percentage / 100);

            //Float val
            $dist_amount = ($percentage_dist * $amount);

            //$dist_amount = ($percentage * $amount);

            //Devide this amount into 6 layers
            $per_user_amount = ($dist_amount / 6);

            $per_user_amount = round($per_user_amount, 2);
            //Create Transaction
            $transaction = DistributorTransaction::create(['level_id' => $distributor->id,
                'total_amount' => $amount,
                'dist_percent' => $percentage,
                'dist_amount' => $dist_amount,
                'per_user_amount' => $per_user_amount]);

            //Add into Earning
            DistributorEarningFromUser::create(['user_id' => $level_one, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);
            DistributorEarningFromUser::create(['user_id' => $level_two, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);
            DistributorEarningFromUser::create(['user_id' => $level_three, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);
            DistributorEarningFromUser::create(['user_id' => $level_four, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);
            DistributorEarningFromUser::create(['user_id' => $level_five, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);
            DistributorEarningFromUser::create(['user_id' => $level_six, 'transaction_id' => $transaction->id,
                'earned' => $per_user_amount]);

            //Update Account Balance

            //Check if this user have a wallet
            //Create if this user doesn't have a wallet
            DistributorWallet::createWalletIfNotExists($level_one);
            DistributorWallet::createWalletIfNotExists($level_two);
            DistributorWallet::createWalletIfNotExists($level_three);
            DistributorWallet::createWalletIfNotExists($level_four);
            DistributorWallet::createWalletIfNotExists($level_five);
            DistributorWallet::createWalletIfNotExists($level_six);

            //Level One
            $level_one_earnings = DistributorWallet::GetTotalEarning($level_one);
            $level_one_balance = DistributorWallet::GetBalance($level_one);

            //Update Total Earnings
            $earn = ((float)$level_one_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_one, $earn);
            //Update current balance
            $balance = ((float)$level_one_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_one, $balance);


            //Level Two
            $level_two_earnings = DistributorWallet::GetTotalEarning($level_two);
            $level_two_balance = DistributorWallet::GetBalance($level_two);

            //Update Total Earnings
            $earn = ((float)$level_two_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_two, $earn);
            //Update current balance
            $balance = ((float)$level_two_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_two, $balance);


            //Level Three
            $level_three_earnings = DistributorWallet::GetTotalEarning($level_three);
            $level_three_balance = DistributorWallet::GetBalance($level_three);

            //Update Total Earnings
            $earn = ((float)$level_three_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_three, $earn);
            //Update current balance
            $balance = ((float)$level_three_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_three, $balance);


            //Level Four
            $level_four_earnings = DistributorWallet::GetTotalEarning($level_four);
            $level_four_balance = DistributorWallet::GetBalance($level_four);

            //Update Total Earnings
            $earn = ((float)$level_four_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_four, $earn);
            //Update current balance
            $balance = ((float)$level_four_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_four, $balance);


            //Level Five
            $level_five_earnings = DistributorWallet::GetTotalEarning($level_five);
            $level_five_balance = DistributorWallet::GetBalance($level_five);

            //Update Total Earnings
            $earn = ((float)$level_five_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_five, $earn);
            //Update current balance
            $balance = ((float)$level_five_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_five, $balance);


            //Level Six
            $level_six_earnings = DistributorWallet::GetTotalEarning($level_six);
            $level_six_balance = DistributorWallet::GetBalance($level_six);

            //Update Total Earnings
            $earn = ((float)$level_six_earnings + (float)$per_user_amount);
            DistributorWallet::SetTotalEarnings($level_six, $earn);
            //Update current balance
            $balance = ((float)$level_six_balance + (float)$per_user_amount);
            DistributorWallet::SetBalance($level_six, $balance);


            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

}