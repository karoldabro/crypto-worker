<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * @template T
 */
abstract class Repository
{
    abstract public function getModel(): Model;

    /**
     * Create new element
     *
     * @param array $validatedData
     * @return T
     */
    public function create(array $validatedData): Model
    {
        $model = $this->getModel();
        $model->fill(Arr::only($validatedData, $model->getFillable()));
        $model->save();

        return $model;
    }

    public function paginateAll()
    {
        return $this->getModel()
            ->query()
            ->paginate();
    }

    /**
     * @param T|string|int $primaryKey
     * @param array $validatedData
     * @return T
     */
    public function update($primaryKey, array $validatedData): Model
    {
        if (is_string($primaryKey) || is_int($primaryKey)) {
            $model = $this->getModel()->find($primaryKey);
        }

        if ($primaryKey instanceof Model) {
            $model = $primaryKey;
        }

        $model->fill(Arr::only($validatedData, $model->getFillable()));
        $model->save();

        return $model;
    }
}
