<?php


namespace sam0hack\Distributor\Tests;


use sam0hack\Distributor\DistributorBaseServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{

    protected function setUp(): void {
        parent::setUp();
        $this->withFactories(__DIR__.'/../database/Factories');
    }


    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
          DistributorBaseServiceProvider::class,
        ];
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default','testdb');
        $app['config']->set('database.connections.testdb',[
            'driver'=>'sqlite',
            'database'=>'testdb'
            //'database'=>':memory:' #In memory
        ]);

    }

}