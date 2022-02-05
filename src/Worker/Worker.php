<?php

namespace Kdabrow\CryptoWorker\Worker;

use Carbon\CarbonInterface;
use Kdabrow\CryptoWorker\Jobs\DecisionProcessJob;
use Kdabrow\CryptoWorker\Bot\Klines;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Kdabrow\CryptoWorkerContract\Worker\WorkerDataInterface;

class Worker
{
    public function __construct(
        protected RepositoryInterface $repository, 
        protected ExchangeInterface $exchange,
        protected WorkerDataInterface $data
    ) {
    }

    public function executeStrategy(StrategyInterface $strategy, CarbonInterface $calculationDate): void
    {
        /** @var Klines $klines */
        $klines = app(Klines::class, ['repository' => $this->repository, 'exchange' => $this->exchange, 'data' => $this->data]);

        $calculation = $strategy->calculate($klines->getFresh($calculationDate));

        if ($calculation->indicators) {
            $this->repository->updateIndicators($calculation->indicators);
        }

        if ($calculation->otherData) {
            $this->repository->updateOtherData($calculation->otherData);
        }

        // sync orders

        // get Active order

        // Decision making process

        // Sync decision in database

        // init decision executor
        // DecisionProcessJob::dispatch()
    }
}
