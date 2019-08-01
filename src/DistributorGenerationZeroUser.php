<?php


namespace sam0hack\Distributor;


use Illuminate\Database\Eloquent\Model;

class DistributorGenerationZeroUser extends Model
{
    protected $guarded = [];

    public static function addGenerationZeroUser($id)
    {
        try {
            $user = DistributorGenerationZeroUser::where('user_id', $id)->first();
            if ($user === null) {
                DistributorGenerationZeroUser::create(['user_id' => $id]);
                DistributorCode::createUserCode($id);
                return true;
            } else {
                //Skip
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * checkIfSixGenZeroUsersExists
     * @return bool
     */
    public static function checkIfSixGenZeroUsersExists()
    {

        try {

            $count = DistributorGenerationZeroUser::count('id');

            if (empty($count)) {
                return false;
            }
            if ($count < 6) {
                return false;
            }
            return true;
        } catch (\Exception $exception) {
            return false;
        }

    }
}