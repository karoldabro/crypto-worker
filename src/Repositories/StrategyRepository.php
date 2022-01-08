<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\Strategy;
use Illuminate\Database\Eloquent\Model;

/**
 * Class StrategyRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<Strategy>
 *
 * @method Strategy|null find($id)
 * @method Strategy findOrFail($id)
 */
class StrategyRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new Strategy;
    }
}
