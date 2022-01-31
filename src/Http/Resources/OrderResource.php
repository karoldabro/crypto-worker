<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="OrderResource",
 *     title="Response for Order entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="external_id", type="string", description="", example=""),
 *     @OA\Property(property="active_strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="status", type="string", description="", example=""),
 *     @OA\Property(property="symbol", type="string", description="", example=""),
 *     @OA\Property(property="type", type="string", description="", example=""),
 *     @OA\Property(property="side", type="string", description="", example=""),
 *     @OA\Property(property="price", type="double", description="", example=""),
 *     @OA\Property(property="quantity", type="integer", description="", example=""),
 *     @OA\Property(property="activation_price", type="double", description="", example=""),
 *     @OA\Property(property="stop_loss", type="double", description="", example=""),
 *     @OA\Property(property="registered_at", type="timestamp", description="", example=""),
 *     @OA\Property(property="executed_at", type="timestamp", description="", example=""),
 *     @OA\Property(property="closed_at", type="timestamp", description="", example=""),
 * )
 */
class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'external_id' => $this->external_id,
            'active_strategy_id' => $this->active_strategy_id,
            'strategy_id' => $this->strategy_id,
            'exchange_id' => $this->exchange_id,
            'status' => $this->status,
            'symbol' => $this->symbol,
            'type' => $this->type,
            'side' => $this->side,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'activation_price' => $this->activation_price,
            'stop_loss' => $this->stop_loss,
            'registered_at' => $this->registered_at,
            'executed_at' => $this->executed_at,
            'closed_at' => $this->closed_at,
        ];
    }
}
