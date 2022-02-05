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
            'active_strategy_id' => ActiveStrategy::factory(),
            'strategy_id' => function(array $attributes) {
                $ac = ActiveStrategy::find($attributes['active_strategy_id']);
                return Strategy::find($ac->strategy_id);
            },
            'exchange_id' => function(array $attributes) {
                $ac = ActiveStrategy::find($attributes['active_strategy_id']);
                return Exchange::find($ac->exchange_id);
            },
            'status' => 'NEW',
            'symbol' => 'BTC:USDT',
            'type' => 'STOP_LOSS',
            'side' => 'LONG',
            'price' => $this->faker->numberBetween(0.0001, 100000),
            'quantity' => $this->faker->numberBetween(0, 1000),
        ];
    }
}