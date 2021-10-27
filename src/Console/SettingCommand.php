<?php


namespace sam0hack\Distributor\Console;

use Illuminate\Console\Command;
use sam0hack\Distributor\DistributorGenerationZeroUser;
use sam0hack\Distributor\DistributorSetting;

class SettingCommand extends Command
{
    protected $signature = 'distributor:install-settings';
    protected $description = 'This will install default settings for distributors (REQUIRED)';

    public function handle()
    {
        $this->comment('Installing default settings.....');
        $this->comment('adding default limit..');
        DistributorSetting::setLimit(10); //Default Limit
        $this->comment('adding default Distribution amount percentage...');
        DistributorSetting::setDistributionPercentage(2); //Default Percentage
        $this->comment('Done..................');
        $checkGenZero = DistributorGenerationZeroUser::checkIfSixGenZeroUsersExists();
        if ($checkGenZero === false) {
            $this->error('This System will need at least 6 generation zero users');
            $this->info('Please run distributor:generation-zero');
        } else {
            $this->info('Evething looks good!');
        }

    }

}