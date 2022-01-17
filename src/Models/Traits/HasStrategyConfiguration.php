<?php

namespace Kdabrow\CryptoWorker\Models\Traits;

use Carbon\CarbonInterval;
use Kdabrow\CryptoWorkerContract\Strategy\Enums\Interval;

trait HasStrategyConfiguration
{
    public function getStrategyId(): string
    {
        return $this->strategy_id;
    }

    public function getExchangeId(): string
    {
        return $this->exchange_id;
    }

    public function getPair(): string
    {
        return $this->pair;
    }

    public function getKlineInterval(): Interval|string
    {
        return $this->kline_interval;
    }

    public function getKlineQuantity(): int
    {
        return $this->kline_quantity;
    }

    public function getRefreshInterval(): CarbonInterval
    {
        return $this->refresh_interval;
    }
}
