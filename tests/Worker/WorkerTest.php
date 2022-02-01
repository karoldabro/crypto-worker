<?php

namespace Kdabrow\CryptoWorker\Tests\Worker;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Kdabrow\CryptoWorker\Bot\Klines;
use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Kdabrow\CryptoWorker\Worker\Worker;
use Kdabrow\CryptoWorker\Tests\TestCase;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Strategy\DataObjects\Calculation;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Mockery;
use Mockery\MockInterface;

class WorkerTest extends TestCase
{
    /** @test */
    public function it_calculates_indicators()
    {
        $calculationDate = new Carbon();
        $klinesCollection = new Collection();
        $mockExchange = Mockery::mock(ExchangeInterface::class);
        $mockRepository = Mockery::mock(RepositoryInterface::class);
        $data = ActiveStrategy::factory()->create();

        $mockKlines = $this->mock(Klines::class, function(MockInterface $mock) use ($calculationDate, $klinesCollection) {
            $mock->shouldReceive('getFresh')->once()->with($calculationDate)->andReturn($klinesCollection);
        });
        $this->app->bind(Klines::class, fn() => $mockKlines);
        
        $worker = new Worker($mockRepository, $mockExchange, $data);

        $calculation = new Calculation();

        $mockStrategy = Mockery::mock(StrategyInterface::class);
        $mockStrategy->shouldReceive('calculate')->once()->with($klinesCollection)->andReturn($calculation);

        $worker->executeStrategy($mockStrategy, $calculationDate);
    }
}