<?php

namespace Kdabrow\CryptoWorker\Casts;

use Carbon\CarbonInterval;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Contracts\Database\Eloquent\SerializesCastableAttributes;

class IntervalCast implements CastsAttributes, SerializesCastableAttributes
{
    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param string $value
     * @param array $attributes
     * @return CarbonInterval
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return CarbonInterval::fromString($value);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param CarbonInterval|string $value
     * @param array $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes)
    {
        return $this->transformToISO($value);
    }

    public function serialize($model, string $key, $value, array $attributes)
    {
        return $this->transformToISO($value);
    }

    private function transformToISO(CarbonInterface|string $value): string
    {
        if ($value instanceof CarbonInterval) {
            return $value->spec();
        }
        
        return $value;
    }
}
