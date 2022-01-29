<?php

namespace Kdabrow\CryptoWorker\Worker\Repositories;

use Illuminate\Support\Collection;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Kdabrow\CryptoWorkerContract\Worker\WorkerDataInterface;
use Carbon\CarbonInterface;

class DatabaseRepository implements RepositoryInterface
{
    public function __construct(private WorkerDataInterface $data, private KlineRepository $repository)
    {
    }
    
    public function isSynced(CarbonInterface $since): bool
    {
        return $this->repository->existsInGivenPeriod(
            $this->data->getPair(),
            $this->data->getKlineInterval(),
            $this->data->getExchangeId(),
            $since->subtract($this->data->getRefreshInterval())
        );
    }

    public function update(): bool
    {

    }

    public function get(CarbonInterface $since, CarbonInterface $until): Collection
    {

    }
}