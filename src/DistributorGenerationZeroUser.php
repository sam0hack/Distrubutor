<?php


namespace sam0hack\Distributor;


use Illuminate\Database\Eloquent\Model;

class DistributorGenerationZeroUser extends Model
{
    protected $guarded = [];

    public static function addGenerationZeroUser($id)
    {
        $user = DistributorGenerationZeroUser::where('user_id', $id)->first();
        if ($user === null) {

            DistributorGenerationZeroUser::create(['user_id' => $id]);
            DistributorCode::createUserCode($id);
            return true;
        } else {
            //Skip
        }
    }
}