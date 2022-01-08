<?php

namespace Kdabrow\CryptoWorker\Repositories;

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
}
