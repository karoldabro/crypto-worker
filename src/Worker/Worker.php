<?php

namespace Kdabrow\CryptoWorker\Worker;

use Carbon\CarbonInterface;
use Kdabrow\CryptoWorker\Jobs\DecisionProcessJob;
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
        if ($quantityOfMissingKlines = $this->repository->isSynced($calculationDate)) {
            $klines = $this->exchange->klines(
                $this->data->getPair(), 
                $this->data->getKlineInterval(), 
                $quantityOfMissingKlines
            );

            $this->repository->updateKlines($klines);
        }

        $klines = $this->repository->get(
            $calculationDate->copy()->sub($this->data->getRefreshInterval()),
            $calculationDate
        );

        $calculation = $strategy->calculate($klines);

        // update calculations into database
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
