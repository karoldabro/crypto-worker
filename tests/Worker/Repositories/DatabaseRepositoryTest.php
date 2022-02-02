<?php

namespace Kdabrow\CryptoWorker\Tests\Worker\Repositories;

use Carbon\Carbon;
use Kdabrow\CryptoWorker\Worker\Repositories\DatabaseRepository;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorker\Tests\TestCase;

class DatabaseRepositoryTest extends TestCase
{
    /** @test */
    public function it_is_synced_while_database_has_klines_from_strategy_refresh_interval()
    {
        $as = ActiveStrategy::factory(['symbol' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $since = new Carbon("2021-06-15 12:00:00");

        Kline::factory(['interval' => '15m', 'symbol' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => $since])->create();

        $source = new DatabaseRepository($as, new KlineRepository);

        $this->assertEquals(1, $source->isSynced($since));
    }
    
    /** @test */
    public function it_is_synced_while_database_has_klines_on_the_egde_of_refresh_interval()
    {
        $as = ActiveStrategy::factory(['symbol' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        Kline::factory(['interval' => '15m', 'symbol' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => new Carbon("2021-06-15 11:55:00")])->create();

        $source = new DatabaseRepository($as, new KlineRepository);

        $this->assertEquals(1, $source->isSynced(new Carbon("2021-06-15 12:00:00")));
    }

    /** @test */
    public function it_is_not_synced_while_database_not_has_latest_klines()
    {
        $as = ActiveStrategy::factory(['symbol' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        Kline::factory(['interval' => '15m', 'symbol' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => new Carbon("2021-06-15 11:54:59")])->create();

        $source = new DatabaseRepository($as, new KlineRepository);

        $this->assertEquals(0, $source->isSynced(new Carbon("2021-06-15 12:00:00")));
    }
}