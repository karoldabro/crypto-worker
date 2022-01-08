<?php

namespace Kdabrow\CryptoWorker;

use Illuminate\Support\ServiceProvider;

class CryptoWorkerProvider extends ServiceProvider
{
    public function register()
    {
        $this->loadMigrationsFrom(__DIR__ . "/../database/migrations");
        $this->loadRoutesFrom(__DIR__ . "/../routes/api.php");
    }
}
