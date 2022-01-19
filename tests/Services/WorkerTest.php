<?php

namespace Kdabrow\CryptoWorker\Tests\Services;

use Carbon\Carbon;
use Kdabrow\CryptoWorker\Services\Worker;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;
use Kdabrow\CryptoWorkerContract\Worker\DataSourceInterface;
use Mockery;

class WorkerTest extends TestCase
{
    /** @test */
    public function it_do_not_update_klines_when_are_already_updated()
    {
        $mockDataSource = Mockery::mock(DataSourceInterface::class);
        $mockDataSource->shouldReceive('isSynced')->with(new Carbon())->andReturn(true);

        // $mockDataSource->shouldNotReceive('update');

        $worker = new Worker($mockDataSource, Mockery::mock(ExchangeInterface::class));

        $worker->executeStrategy(Mockery::mock(StrategyInterface::class));
    }
}