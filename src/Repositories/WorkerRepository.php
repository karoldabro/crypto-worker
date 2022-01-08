<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\Worker;
use Illuminate\Database\Eloquent\Model;

/**
 * Class WorkerRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<Worker>
 *
 * @method Worker|null find($id)
 * @method Worker findOrFail($id)
 */
class WorkerRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new Worker;
    }
}
