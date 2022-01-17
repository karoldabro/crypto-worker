<?php

namespace Kdabrow\CryptoWorker\Tests\Unit;

use Carbon\Carbon;
use Kdabrow\CryptoWorker\DataSources\DatabaseSource;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Models\Kline;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorker\Tests\TestCase;

class DatabaseSourceTest extends TestCase
{
    /** @test */
    public function it_is_synced_while_database_has_klines_from_strategy_refresh_interval()
    {
        $as = ActiveStrategy::factory(['pair' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $since = new Carbon("2021-06-15 12:00:00");

        Kline::factory(['interval' => '15m', 'pair' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => $since])->create();

        $source = new DatabaseSource($as, new KlineRepository);

        $this->assertTrue($source->isSynced($since));
    }
    
    /** @test */
    public function it_is_synced_while_database_has_klines_on_the_egde_of_refresh_interval()
    {
        $as = ActiveStrategy::factory(['pair' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $since = new Carbon("2021-06-15 11:55:00");

        Kline::factory(['interval' => '15m', 'pair' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => $since])->create();

        $source = new DatabaseSource($as, new KlineRepository);

        $this->assertTrue($source->isSynced($since));
    }

    /** @test */
    public function it_is_not_synced_while_database_not_has_latest_klines()
    {
        $as = ActiveStrategy::factory(['pair' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $since = new Carbon("2021-06-15 11:54:59");

        Kline::factory(['interval' => '15m', 'pair' => 'USD:BTC', 'exchange_id' => $as->exchange_id, 'timestamp' => $since])->create();

        $source = new DatabaseSource($as, new KlineRepository);

        $this->assertTrue($source->isSynced($since));
    }
}