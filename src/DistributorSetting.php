<?php


namespace sam0hack\Distributor;


use Exception;
use Illuminate\Database\Eloquent\Model;


class DistributorSetting extends Model
{
    protected $guarded = [];


    /**
     * Create or update limit
     * @param $limit
     * @return bool
     */
    public static function setLimit($limit)
    {

        try {
            $settings = DistributorSetting::where('meta', 'limit')->first();
            if ($settings === null) {
                //New Entry
                DistributorSetting::create(['meta' => 'limit', 'value' => $limit]);
                return true;
            } else {
                $settings->value = $limit;
                $settings->save();
                return true;
            }

        } catch (Exception $e) {
            return false;
        }
    }


    /**
     * Create or update distribution amount percentage
     * @param $percentage
     * @return bool
     */
    public static function setDistributionPercentage($percentage)
    {

        try {
            $settings = DistributorSetting::where('meta', 'dist_percentage')->first();
            if ($settings === null) {
                //New Entry
                DistributorSetting::create(['meta' => 'dist_percentage', 'value' => $percentage]);
                return true;
            } else {
                $settings->value = $percentage;
                $settings->save();
                return true;
            }

        } catch (Exception $e) {
            return false;
        }


    }


    public static function getPercantage()
    {
        try {
            $percentage = DistributorSetting::where('meta', 'dist_percentage')->first();
            if ($percentage === null) {
                return false;
            }
            return $percentage->value;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * getLimit
     * @return number|bool
     */
    public static function getLimit()
    {
        try {
            $limit = DistributorSetting::where('meta', 'limit')->first();
            if ($limit === null) {
                return false;
            }
            return $limit->value;
        } catch (Exception $e) {
            return false;
        }
    }

}
