<?php


namespace sam0hack\Distributor\Console;


use Illuminate\Console\Command;
use sam0hack\Distributor\Distributor;
use sam0hack\Distributor\DistributorCode;
use sam0hack\Distributor\DistributorGenerationZeroUser;
use sam0hack\Distributor\DistributorLevel;

class ProcessCommand extends Command
{

    protected $signature = 'distributor:generation-zero';
    protected $description = 'This will create Generation zero users. These are the highest level users. (REQUIRED) ';

    public function handle()
    {
        $choice = $this->choice('Choose action', ['1' => 'Manually add user ID', '2' => 'Autogenerate']);

        if ($choice === 'Manually add user ID') {

            $input = $this->ask('Enter the user id. You can use multiple user id\'s. I.e 1,2,4,90 ');
            $this->comment('These users are the highest level users So there there will no referral above them');

            $return = self::generateGenerationZero($input);
            $errors = $return['errors'];
            $success = $return['success'];

            if (!empty($errors)) {
                foreach ($errors as $error) {
                    $this->error($error['data']);
                }
            }
            if (!empty($success)) {
                foreach ($success as $data) {
                    $this->comment($data['data']);
                }
            }
        } else {
            $users = '1, 2, 3, 4, 5, 6';
            $return = self::generateGenerationZero($users);

            $errors = $return['errors'];
            $success = $return['success'];
            if (!empty($errors)) {
                foreach ($errors as $error) {
                    $this->error($error['data']);
                }
            }
            if (!empty($success)) {
                foreach ($success as $data) {
                    $this->comment($data['data']);
                }
            }
        }
    }


    /**
     * Generate Generation Zero Users
     * @param $input
     * @return array
     */
    protected static function generateGenerationZero($input)
    {
        $users = explode(",", $input);
        $success = [];
        $errors = [];


        foreach ($users as $user) {
            //Validate

            $is_exits = Distributor::checkIfUserLevelExists($user);
            if ($is_exits === false) {
                $user = trim($user);

                if (!is_int((int)$user) OR $user == 0) {
                    array_push($errors, ['status' => 'error', 'data' => "User id ($user) should be an integer"]);
                } else {
                    //Insert into Generation Zero users
                    DistributorGenerationZeroUser::addGenerationZeroUser($user);
                    array_push($success, ['status' => 'ok', 'data' => "User id ($user) has been successfully added"]);

                }
            }
        }

        //Add These users in Distributor Table
        $first_user = DistributorGenerationZeroUser::orderBy('id', 'ASC')->first();
        $counts = DistributorGenerationZeroUser::count();


        $is_exits = Distributor::checkIfUserLevelExists($user);
        if ($is_exits === false) {

            $code = DistributorCode::where('user_id', $first_user->user_id)->first();
            Distributor::create(['user_id' => $first_user->user_id, 'code' => $code->referral_code]);
        }

        for ($i = 1; $i < $counts; $i++) {
            //Get Prevoius user code
            if ($i == 1) {
                //Get first user code
                $code = DistributorCode::where('user_id', $first_user->user_id)->first();
            } else {
                //fetch last one user code
                $n = $i - 1;
                $gen_zero_user = DistributorGenerationZeroUser::skip($n)->take(1)->first();
                $code = DistributorCode::where('user_id', $gen_zero_user->user_id)->first();

            }

            //Add to Distributors Table
            $gen_zero_user = DistributorGenerationZeroUser::skip($i)->take(1)->first();
            $is_exits = Distributor::checkIfUserLevelExists($gen_zero_user->user_id);
            if ($is_exits === false) {
                Distributor::create(['user_id' => $gen_zero_user->user_id, 'code' => $code->referral_code]);
                //Make levels for inital users
                DistributorLevel::levelMaker($gen_zero_user->user_id, $code->referral_code);
            }
        }

        return ['errors' => $errors, 'success' => $success];
    }

}
