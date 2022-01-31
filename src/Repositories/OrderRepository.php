<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\Order;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<Order>
 *
 * @method Order|null find($id)
 * @method Order findOrFail($id)
 */
class OrderRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new Order;
    }
}
