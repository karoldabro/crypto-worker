<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ExchangeResource",
 *     title="Response for Exchange entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="name", type="string", description="", example=""),
 * )
 */
class ExchangeResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'name' => $this->name,
        ];
    }
}
