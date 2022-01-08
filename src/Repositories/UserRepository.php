<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Kdabrow\CryptoWorker\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserRepository
 * @package Kdabrow\CryptoWorker\Repositories
 * @extends Repository<User>
 *
 * @method User|null find($id)
 * @method User findOrFail($id)
 */
class UserRepository extends Repository
{
    /**
     * @return User
     */
    public function getModel(): Model
    {
        return new User;
    }
}
