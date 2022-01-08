<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="KlineResource",
 *     title="Response for Kline entity", 
 *     @OA\Property(property="id", type="bigIncrements", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="timestamp", type="timestamp", description="", example=""),
 *     @OA\Property(property="interval", type="string", description="", example=""),
 *     @OA\Property(property="open", type="decimal", description="", example=""),
 *     @OA\Property(property="high", type="decimal", description="", example=""),
 *     @OA\Property(property="low", type="decimal", description="", example=""),
 *     @OA\Property(property="close", type="decimal", description="", example=""),
 *     @OA\Property(property="volume", type="decimal", description="", example=""),
 * )
 */
class KlineResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'pair' => $this->pair,
            'exchange_id' => $this->exchange_id,
            'timestamp' => $this->timestamp,
            'interval' => $this->interval,
            'open' => $this->open,
            'high' => $this->high,
            'low' => $this->low,
            'close' => $this->close,
            'volume' => $this->volume,
        ];
    }
}
