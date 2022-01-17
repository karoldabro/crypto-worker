<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ActiveStrategyUpdateRequest",
 *     title="Request for update ActiveStrategy entity", 
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kline_interval", type="string", description="Kandle interval", example=""),
 *     @OA\Property(property="kline_quantity", type="integer", description="How much klines goes to strategy calculation", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="How frequently strategy is calculated", example=""),
 * )
 */
class UpdateActiveStrategyRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'strategy_id' => ['uuid', 'exists:strategies,id'],
                'exchange_id' => ['uuid', 'exists:exchanges,id'],
                'pair' => ['string'],
                'kline_interval' => ['sometimes', 'nullable', 'string'],
                'kline_quantity' => ['integer', 'min:1'],
                'refresh_interval' => ['sometimes', 'nullable', 'string'],
        ];
    }
}