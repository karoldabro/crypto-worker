<?php

namespace Kdabrow\CryptoWorker\Tests\Repositories;

use Carbon\Carbon;
use Kdabrow\CryptoWorker\Models\Exchange;
use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorker\Tests\TestCase;

class KlineRepositoryTest extends TestCase
{
    /** @test */
    public function it_return_true_when_found_kline_in_given_period()
    {
        $exchange = Exchange::factory()->create();

        $since = new Carbon("2021-06-15 12:00:00");

        Kline::factory(['interval' => '15m', 'symbol' => 'USD:BTC', 'exchange_id' => $exchange->id, 'timestamp' => $since])->create();

        $repository = new KlineRepository();

        $this->assertTrue($repository->existsInGivenPeriod('USD:BTC', '15m', $exchange->id, $since));
    }

    /** @test */
    public function it_return_false_when_not_found_kline_in_given_period()
    {
        $exchange = Exchange::factory()->create();

        $since = new Carbon("2021-06-15 12:00:00");

        Kline::factory(['interval' => '15m', 'symbol' => 'USD:BTC', 'exchange_id' => $exchange->id])->until($since->copy()->subMinute())->count(10)->create();

        $repository = new KlineRepository();

        $this->assertFalse($repository->existsInGivenPeriod('USD:BTC', '15m', $exchange->id, $since));
    }
}