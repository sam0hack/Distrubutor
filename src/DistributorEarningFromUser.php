<?php


    namespace sam0hack\Distributor;


    use Exception;
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
                DistributorEarningFromUser::create(['user_id' => $user_id, 'transaction_id' => $transaction_id,
                    'earned' => $earned]);
                return true;
            } catch (Exception $e) {
                return false;
            }
        }


        public static function getLevelEarnings($user_id, $level)
        {


            $earning_from_users = DistributorEarningFromUser::where('user_id', $user_id)->sum('earned');

            $level_earnings1 = DistributorEarningFromUser::where('user_id', $user_id)->get();

            $level_one = 0;
            $level_one_team = 0;
            $level_two = 0;
            $level_two_team = 0;
            $level_three = 0;
            $level_three_team = 0;
            $level_four = 0;
            $level_four_team = 0;
            $level_five = 0;
            $level_five_team = 0;
//            $level_six = 0;
//            $level_six_team = 0;

            $d = [];


            $transaction_id = [];
            $data_set = [];
            foreach ($level_earnings1 as $earning) {
                if (!in_array($earning->transaction_id, $transaction_id)) {
                    $earning_from_transaction = DistributorEarningFromUser::where('user_id', $user_id)->where('transaction_id', $earning->transaction_id)->sum('earned');
                    array_push($transaction_id, $earning->transaction_id);
                    array_push($data_set, [$earning->transaction_id, $earning_from_transaction]);
                }

            }


            $l_array = [];
            foreach ($data_set as $set) {

                $transaction_id = $set[0];
                $earning_from_transaction = $set[1];


                $dist_by = DistributorTransaction::where('id', $transaction_id)->first();

                $dist_by = $dist_by->level_id;


                if (!empty(DistributorLevelOne::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {

                    $l1 = DistributorLevelOne::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
                    if (!in_array($l1->level_user_id, $l_array)) {
                        $level_one_team = $level_one_team + 1;
                        array_push($l_array, $l1->level_user_id);
                    }
                    $level_one = $level_one + $earning_from_transaction;


                } elseif (!empty(DistributorLevelTwo::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {

                    $l2 = DistributorLevelTwo::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
                    if (!in_array($l2->level_user_id, $l_array)) {
                        $level_two_team = $level_two_team + 1;
                        array_push($l_array, $l2->level_user_id);
                    }


                    $level_two = $level_two + $earning_from_transaction;

                } elseif (!empty(DistributorLevelThree::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {

                    $l3 = DistributorLevelThree::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
                    if (!in_array($l3->level_user_id, $l_array)) {
                        $level_three_team = $level_three_team + 1;
                        array_push($l_array, $l3->level_user_id);
                    }


                    $level_three = $level_three + $earning_from_transaction;
                } elseif (!empty(DistributorLevelFour::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {

                    $l4 = DistributorLevelFour::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
                    if (!in_array($l4->level_user_id, $l_array)) {
                        $level_four_team = $level_four_team + 1;
                        array_push($l_array, $l4->level_user_id);
                    }


                    $level_four = $level_four + $earning_from_transaction;
                } elseif (!empty(DistributorLevelFive::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {

                    $l5 = DistributorLevelFive::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
                    if (!in_array($l5->level_user_id, $l_array)) {
                        $level_five_team = $level_five_team + 1;
                        array_push($l_array, $l5->level_user_id);
                    }


                    $level_five = $level_five + $earning_from_transaction;
//                } elseif (!empty(DistributorLevelSix::where('user_id', $user_id)->where('level_user_id', $dist_by)->first())) {
//
//                    $l6 = DistributorLevelSix::where('user_id', $user_id)->where('level_user_id', $dist_by)->first();
//
//                    if (!in_array($l6->level_user_id, $l_array)) {
//                        $level_six_team = $level_six_team + 1;
//                        array_push($l_array, $l6->level_user_id);
//                    }
//
//
//                    $level_six = $level_six + $earning_from_transaction;
                } else {

                }


            }


            //Get list of downline

            $dc = new DistributorController();
            $level_teams_data = $dc->levels($user_id);



            $level_1 = array(
                'total_earned' => (string)$level_one,
                'total_team' => (string)count($level_teams_data[0]['level_1'])
            );
            $level_2 = array(
                'total_earned' => (string)$level_two,
                'total_team' => (string)count($level_teams_data[1]['level_2'])
            );
            $level_3 = array(
                'total_earned' => (string)$level_three,
                'total_team' => (string)count($level_teams_data[2]['level_3'])
            );
            $level_4 = array(
                'total_earned' => (string)$level_four,
                'total_team' => (string)count($level_teams_data[3]['level_4'])
            );
            $level_5 = array(
                'total_earned' => (string)$level_five,
                'total_team' => (string)count($level_teams_data[4]['level_5'])
            );
//            $level_6 = array(
//                'total_earned' => (string)$level_six,
//                'total_team' => (string)count($level_teams_data[5]['level_6'])
//            );

            $total_team = count($level_teams_data[0]['level_1'])  + count($level_teams_data[1]['level_2']) + count($level_teams_data[2]['level_3']) + count($level_teams_data[3]['level_4'])
                +count($level_teams_data[4]['level_5']);

            return ['level_one' => $level_1, 'level_two' => $level_2, 'level_three' => $level_3, 'level_four' => $level_4, 'level_five' => $level_5,
                'earning' => $earning_from_users,'total_team'=>$total_team
            ];



        }

    }
