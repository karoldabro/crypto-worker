<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Carbon\CarbonInterface;
use Kdabrow\CryptoWorker\Models\Kline;
use Illuminate\Database\Eloquent\Model;

/**
 * Class KlineRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<Kline>
 *
 * @method Kline|null find($id)
 * @method Kline findOrFail($id)
 */
class KlineRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new Kline;
    }

    public function existsInGivenPeriod(
        string $pair,
        string $interval,
        string $exchangeId,
        CarbonInterface $since
    ): bool
    {
        return $this
            ->getModel()
            ->query()
            ->where('pair', '=', $pair)
            ->where('interval', '=', $interval)
            ->where('exchange_id', '=', $exchangeId)
            ->where('timestamp', '>=', $since)
            ->exists();
    }
}
