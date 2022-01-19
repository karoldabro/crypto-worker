<?php

namespace Kdabrow\CryptoWorker\Services;

use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;
use Kdabrow\CryptoWorkerContract\Worker\DataSourceInterface;

class Worker
{
    public function __construct(
        protected DataSourceInterface $dataSource, 
        protected ExchangeInterface $exchange, 
    ) {
    }

    public function executeStrategy(StrategyInterface $strategy): void
    {
        if ($this->dataSource->isSynced() == false) {

        }
    }
}
