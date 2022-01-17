<?php

namespace Kdabrow\CryptoWorker\DataSources;

use Illuminate\Collections\Collection;
use Kdabrow\CryptoWorker\Repositories\KlineRepository;
use Kdabrow\CryptoWorkerContract\Worker\DataSourceInterface;
use Kdabrow\CryptoWorkerContract\Worker\ConfigurationInterface;
use Carbon\CarbonInterface;
use Carbon\Carbon;

class DatabaseSource implements DataSourceInterface
{
    public function __construct(private ConfigurationInterface $configuration, private KlineRepository $repository)
    {
    }
    
    public function isSynced(CarbonInterface $since = new Carbon()): bool
    {
        return $this->repository->existsInGivenPeriod(
            $this->configuration->getPair(),
            $this->configuration->getKlineInterval(),
            $this->configuration->getExchangeId(),
            $since->subtract($this->configuration->getRefreshInterval())
        );
    }

    public function update(): bool
    {

    }

    public function get(): Collection
    {

    }
}