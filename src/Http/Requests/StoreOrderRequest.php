<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="OrderStoreRequest",
 *     title="Request for create Order entity", 
 *     @OA\Property(property="id", type="uuid", description="", example=""),
 *     @OA\Property(property="external_id", type="string", description="Id on exchange", example=""),
 *     @OA\Property(property="active_strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="status", type="string", description="Describes what is happening with order", example=""),
 *     @OA\Property(property="symbol", type="string", description="", example=""),
 *     @OA\Property(property="type", type="string", description="", example=""),
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
class StoreOrderRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'id' => [],
                'external_id' => ['required', 'string'],
                'active_strategy_id' => ['required', 'uuid', 'exists:active_strategies,id'],
                'status' => ['required', 'string'],
                'symbol' => ['required', 'string'],
                'type' => ['required', 'string'],
                'side' => ['required', 'string'],
                'price' => ['required', 'numeric', 'min:0'],
                'quantity' => ['required', 'integer', 'min:1'],
                'activation_price' => ['numeric'],
                'stop_loss' => ['numeric'],
                'registered_at' => ['integer'],
                'executed_at' => ['integer'],
                'closed_at' => ['integer'],
        ];
    }
}
