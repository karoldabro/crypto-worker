<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="StrategyResource",
 *     title="Response for Strategy entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class StrategyResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'name' => $this->name,
            'kandle_interval' => $this->kandle_interval,
            'refresh_interval' => $this->refresh_interval,
        ];
    }
}
