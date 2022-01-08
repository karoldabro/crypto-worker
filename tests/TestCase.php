<?php

namespace Kdabrow\CryptoWorker\Tests;

use Kdabrow\CryptoWorker\CryptoWorkerProvider;
use Laravel\Sanctum\SanctumServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected $loadEnvironmentVariables = true;

    protected function getPackageProviders($app)
    {
        return [
            CryptoWorkerProvider::class,
            SanctumServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
