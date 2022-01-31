<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Kdabrow\CryptoWorker\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Models\Exchange;
use Kdabrow\CryptoWorker\Models\Strategy;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition()
    {
        return [ 
            'external_id' => $this->faker->slug(2),
            'strategy_id' => Strategy::factory(),
            'exchange_id' => Exchange::factory(),
            'active_strategy_id' => ActiveStrategy::factory(),
            'status' => 'NEW',
            'symbol' => 'BTC:USDT',
            'type' => 'STOP_LOSS',
            'side' => 'LONG',
            'price' => $this->faker->numberBetween(0.0001, 100000),
            'quantity' => $this->faker->numberBetween(0, 1000),
        ];
    }
}