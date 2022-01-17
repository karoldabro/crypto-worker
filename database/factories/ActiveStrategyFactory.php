<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Models\Strategy;
use Kdabrow\CryptoWorker\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActiveStrategyFactory extends Factory
{
    protected $model = ActiveStrategy::class;

    public function definition()
    {
        return [ 
            'strategy_id' => Strategy::factory(),
            'exchange_id' => Exchange::factory(),
            'pair' => $this->faker->currencyCode().":".$this->faker->currencyCode(),
            'kline_interval' => '15m',
            'kline_quantity' => $this->faker->numberBetween(50, 300),
            'refresh_interval' => 'PT'.$this->faker->numberBetween(1, 59).'M',
        ];
    }
}