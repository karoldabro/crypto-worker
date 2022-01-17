<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\ActiveStrategy;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ActiveStrategyRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<ActiveStrategy>
 *
 * @method ActiveStrategy|null find($id)
 * @method ActiveStrategy findOrFail($id)
 */
class ActiveStrategyRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new ActiveStrategy;
    }
}