<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="WorkerResource",
 *     title="Response for Worker entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class WorkerResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'strategy_id' => $this->strategy_id,
            'exchange_id' => $this->exchange_id,
            'pair' => $this->pair,
            'kandle_interval' => $this->kandle_interval,
            'refresh_interval' => $this->refresh_interval,
        ];
    }
}
