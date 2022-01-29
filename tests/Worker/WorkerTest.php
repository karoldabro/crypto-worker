<?php

namespace Kdabrow\CryptoWorker\Tests\Worker;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Worker\Worker;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Strategy\DataObjects\Calculation;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Mockery;

class WorkerTest extends TestCase
{
    /** @test */
    public function it_do_not_update_klines_when_are_already_updated()
    {
        $as = ActiveStrategy::factory(['pair' => 'USD:BTC', 'kline_interval' => '15m', 'refresh_interval' => 'T5M'])->create();

        $calculationDate = new Carbon();
        $klinesCollection = new Collection([]);

        $mockRepository = Mockery::mock(RepositoryInterface::class);
        $mockRepository->shouldReceive('isSynced')->once()->with($calculationDate)->andReturn(true);
        $mockRepository->shouldNotReceive('update');
        $mockRepository->shouldReceive('get')->once()->withSomeOfArgs($calculationDate)->andReturn($klinesCollection);
        
        $worker = new Worker($mockRepository, Mockery::mock(ExchangeInterface::class), $as);

        $calculation = new Calculation();

        $mockStrategy = Mockery::mock(StrategyInterface::class);
        $mockStrategy->shouldReceive('calculate')->once()->with($klinesCollection)->andReturn($calculation);

        $worker->executeStrategy($mockStrategy, $calculationDate);
    }
}