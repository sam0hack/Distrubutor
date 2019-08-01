<?php


namespace sam0hack\Distributor;


use Illuminate\Support\ServiceProvider;
use sam0hack\Distributor\Console\ProcessCommand;

class DistributorBaseServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->registerResources();
    }

    public function register()
    {
        $this->commands([Console\ProcessCommand::class]);
        $this->commands([Console\SettingCommand::class]);

    }

    /**
     *
     */
    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

}