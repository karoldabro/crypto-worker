<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Kdabrow\CryptoWorker\Models\Strategy;
use Illuminate\Database\Eloquent\Factories\Factory;

class StrategyFactory extends Factory
{
    protected $model = Strategy::class;

    public function definition()
    {
        return [ 
            'name' => $this->faker->word,
            'kandle_interval' => '15m',
            'refresh_interval' => '1m',
        ];
    }
}