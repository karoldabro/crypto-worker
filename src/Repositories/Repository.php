<?php

namespace Kdabrow\CryptoWorker\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * @template TModel
 */
abstract class Repository
{
    abstract public function getModel(): Model;

    /**
     * Create new element
     *
     * @param array $validatedData
     * @return TModel
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
     * @param TModel|string|int $primaryKey
     * @param array $validatedData
     * @return TModel
     */
    public function update(Model|string|int $primaryKey, array $validatedData): Model
    {
        $model = $this->determineModel($primaryKey);

        $model->fill(Arr::only($validatedData, $model->getFillable()));
        $model->save();

        return $model;
    }

    /**
     * Finds element by primary key
     *
     * @param integer|string $primaryKey
     * @return TModel|null
     */
    public function find(int|string $primaryKey): ?Model
    {
        return $this
            ->getModel()
            ->find($primaryKey);
    }

    /**
     * Return model by for queries or updates
     *
     * @param TModel|string|integer $primaryKey
     * @return TModel|null
     */
    protected function determineModel(Model|string|int $primaryKey): ?Model
    {
        if ($primaryKey instanceof Model) {
            return $primaryKey;
        }

        return $this->find($primaryKey);
    }
}
