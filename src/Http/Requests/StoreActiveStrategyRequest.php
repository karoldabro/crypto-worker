<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ActiveStrategyStoreRequest",
 *     title="Request for create ActiveStrategy entity", 
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kline_interval", type="string", description="Kandle interval", example=""),
 *     @OA\Property(property="kline_quantity", type="integer", description="How much klines goes to strategy calculation", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="How frequently strategy is calculated", example=""),
 * )
 */
class StoreActiveStrategyRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'strategy_id' => ['required', 'uuid', 'exists:strategies,id'],
                'exchange_id' => ['required', 'uuid', 'exists:exchanges,id'],
                'pair' => ['required', 'string'],
                'kline_interval' => ['sometimes', 'nullable', 'string'],
                'kline_quantity' => ['required', 'integer', 'min:1'],
                'refresh_interval' => ['sometimes', 'nullable', 'string'],
        ];
    }
}