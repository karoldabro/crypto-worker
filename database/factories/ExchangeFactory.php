<?php

namespace Kdabrow\CryptoWorker\Database\Factories;

use Kdabrow\CryptoWorker\Models\Exchange;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeFactory extends Factory
{
    protected $model = Exchange::class;

    public function definition()
    {
        return [ 
            'name' => $this->faker->word,
            'credentials' => ['name' => $this->faker->name, 'password' => $this->faker->name],
        ];
    }
}