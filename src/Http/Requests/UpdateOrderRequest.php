<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="OrderUpdateRequest",
 *     title="Request for update Order entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="status", type="string", description="Describes what is happening with order", example=""),
 *     @OA\Property(property="symbol", type="string", description="", example=""),
 *     @OA\Property(property="side", type="string", description="Long or Short", example=""),
 *     @OA\Property(property="price", type="double", description="", example=""),
 *     @OA\Property(property="quantity", type="integer", description="", example=""),
 *     @OA\Property(property="activation_price", type="double", description="", example=""),
 *     @OA\Property(property="stop_loss", type="double", description="", example=""),
 *     @OA\Property(property="registered_at", type="timestamp", description="When is registered on exchange", example=""),
 *     @OA\Property(property="executed_at", type="timestamp", description="When is activated at exchange", example=""),
 *     @OA\Property(property="closed_at", type="timestamp", description="", example=""),
 * )
 */
class UpdateOrderRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'id' => [],
                'status' => ['string'],
                'type' => ['string'],
                'side' => ['string'],
                'price' => ['numeric', 'min:0'],
                'quantity' => ['integer', 'min:1'],
                'activation_price' => ['numeric'],
                'stop_loss' => ['numeric'],
                'registered_at' => ['integer'],
                'executed_at' => ['integer'],
                'closed_at' => ['integer'],
        ];
    }
}
