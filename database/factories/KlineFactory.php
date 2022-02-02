<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Carbon\CarbonInterface;
use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

class KlineFactory extends Factory
{
    protected $model = Kline::class;

    public function definition()
    {
        return [ 
            'symbol' => $this->faker->currencyCode().":".$this->faker->currencyCode(),
            'exchange_id' => Exchange::factory(),
            'timestamp' => $this->faker->dateTime,
            'interval' => '15m',
            'open' => $this->faker->randomNumber(),
            'high' => $this->faker->randomNumber(),
            'low' => $this->faker->randomNumber(),
            'close' => $this->faker->randomNumber(),
            'volume' => $this->faker->randomNumber(),
            // 'indicators' => $this->faker->words,
            // 'other_data' => $this->faker->words,
        ];
    }

    public function until(CarbonInterface $until)
    {
        return $this->state(function (array $parameters) use ($until) {
            return [
                'timestamp' => $this->faker->dateTime($until),
            ];
        });
    }
}