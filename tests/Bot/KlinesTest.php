<?php

namespace Kdabrow\CryptoWorker\Tests\Bot;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Kdabrow\CryptoWorker\Bot\Klines;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Mockery;

class KlinesTest extends TestCase
{
    /** @test */
    public function it_do_not_update_klines_if_are_actual_in_repository()
    {
        $data = ActiveStrategy::factory(['refresh_interval' => 'T5M'])->create();

        $calculationDate = new Carbon();
        $klinesCollection = new Collection([]);

        $mockRepository = Mockery::mock(RepositoryInterface::class);
        $mockRepository->shouldReceive('isSynced')->once()->with($calculationDate)->andReturn(0);
        $mockRepository->shouldReceive('get')->once()->withSomeOfArgs($calculationDate)->andReturn($klinesCollection);

        $mockExchange = Mockery::mock(ExchangeInterface::class);

        $klines = new Klines($mockRepository, $mockExchange, $data);

        $klines->getFresh($calculationDate);
    }
    
    /** @test */
    public function it_update_klines_if_are_not_actual_in_repository()
    {
        $data = ActiveStrategy::factory(['symbol' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $calculationDate = new Carbon();
        $klinesCollection = new Collection([]);

        $mockRepository = Mockery::mock(RepositoryInterface::class);
        $mockRepository->shouldReceive('isSynced')->once()->with($calculationDate)->andReturn(12);
        $mockRepository->shouldReceive('updateKlines')->once()->with($klinesCollection)->andReturn(true);
        $mockRepository->shouldReceive('get')->once()->withSomeOfArgs($calculationDate)->andReturn($klinesCollection);

        $mockExchange = Mockery::mock(ExchangeInterface::class);
        $mockExchange->shouldReceive('klines')->with('USD:BTC', '15m', 12)->once()->andReturn($klinesCollection);

        $klines = new Klines($mockRepository, $mockExchange, $data);

        $klines->getFresh($calculationDate);
    }
}