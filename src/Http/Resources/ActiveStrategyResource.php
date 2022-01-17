<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ActiveStrategyResource",
 *     title="Response for ActiveStrategy entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kline_interval", type="string", description="", example=""),
 *     @OA\Property(property="kline_quantity", type="integer", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class ActiveStrategyResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'strategy_id' => $this->strategy_id,
            'exchange_id' => $this->exchange_id,
            'pair' => $this->pair,
            'kline_interval' => $this->kline_interval,
            'kline_quantity' => $this->kline_quantity,
            'refresh_interval' => $this->refresh_interval,
        ];
    }
}