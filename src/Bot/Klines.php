<?php

namespace Kdabrow\CryptoWorker\Bot;

use Carbon\CarbonInterface;
use Illuminate\Support\Collection;
use Kdabrow\CryptoWorkerContract\Exchange\ExchangeInterface;
use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;
use Kdabrow\CryptoWorkerContract\Worker\WorkerDataInterface;

class Klines
{
    public function __construct(
        protected RepositoryInterface $repository,
        protected ExchangeInterface $exchange,
        protected WorkerDataInterface $data
    ) {
    }

    public function getFresh(CarbonInterface $calculationDate): Collection
    {
        $this->updateFromExchange($calculationDate);

        return $this->repository->get(
            $calculationDate->copy()->sub($this->data->getRefreshInterval()),
            $calculationDate
        );
    }

    private function updateFromExchange(CarbonInterface $calculationDate): bool
    {
        if ($quantityOfMissingKlines = $this->repository->isSynced($calculationDate)) {
            $klines = $this->exchange->klines(
                $this->data->getSymbol(),
                $this->data->getKlineInterval(),
                $quantityOfMissingKlines
            );

            return $this->repository->updateKlines($klines);
        }

        return true;
    }
}