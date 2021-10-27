<?php


namespace sam0hack\Distributor;


use Illuminate\Support\ServiceProvider;

class DistributorBaseServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->registerResources();
    }

    /**
     *
     */
    private function registerResources(){
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function register()
    {
        $this->commands([Console\ProcessCommand::class]);
        $this->commands([Console\SettingCommand::class]);

    }

}
