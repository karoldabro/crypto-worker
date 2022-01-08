<?php

namespace Kdabrow\CryptoWorker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     title="Response for User entity", 
 *     @OA\Property(property="id", type="string", description="", example=""),
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="email", type="string", description="", example="")
 * )
 */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [ 
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
