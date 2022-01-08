<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\Exchange;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ExchangeRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<Exchange>
 *
 * @method Exchange|null find($id)
 * @method Exchange findOrFail($id)
 */
class ExchangeRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new Exchange;
    }
}
