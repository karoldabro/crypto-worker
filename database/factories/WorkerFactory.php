<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Kdabrow\CryptoWorker\Models\Worker;
use Kdabrow\CryptoWorker\Models\Strategy;
use Kdabrow\CryptoWorker\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

class WorkerFactory extends Factory
{
    protected $model = Worker::class;

    public function definition()
    {
        return [ 
            'strategy_id' => Strategy::factory(),
            'exchange_id' => Exchange::factory(),
            'pair' => $this->faker->currencyCode().":".$this->faker->currencyCode(),
            'kandle_interval' => '15m',
            'refresh_interval' => '1m',
        ];
    }
}