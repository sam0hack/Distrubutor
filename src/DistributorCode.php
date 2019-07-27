<?php


namespace sam0hack\Distributor;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

class DistributorCode extends Model
{
    protected $guarded = [];

    /**
     * createUserCode
     * @param $user_id
     * @return array|bool
     */
    public static function createUserCode($user_id)
    {
        try {
            $is_exists = DistributorCode::where('user_id', $user_id)->first();
            if (!empty($is_exists)) {
                //Skip
            } else {
                //Random Code Generate
                $code = Str::random(10);
                $distributor = DistributorCode::Create(['user_id' => $user_id, 'referral_code' => $code]);
                return $distributor;
            }
        } catch (\Exception $e) {
            return false;
        }
        return false;
    }
}