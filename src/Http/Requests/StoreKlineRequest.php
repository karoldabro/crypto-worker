<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="KlineStoreRequest",
 *     title="Request for create Kline entity", 
 *     @OA\Property(property="symbol", type="string", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="timestamp", type="timestamp", description="", example=""),
 *     @OA\Property(property="interval", type="string", description="", example=""),
 *     @OA\Property(property="open", type="decimal", description="", example=""),
 *     @OA\Property(property="high", type="decimal", description="", example=""),
 *     @OA\Property(property="low", type="decimal", description="", example=""),
 *     @OA\Property(property="close", type="decimal", description="", example=""),
 *     @OA\Property(property="volume", type="decimal", description="", example=""),
 *     @OA\Property(property="indicators", type="jsonb", description="Indicators calculated in strategy", example=""),
 *     @OA\Property(property="other_data", type="jsonb", description="", example=""),
 * )
 */
class StoreKlineRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'symbol' => ['required', 'string', 'max:10'],
                'exchange_id' => ['required', 'uuid', 'exists:exchanges,id'],
                'timestamp' => ['required', 'integer'],
                'interval' => ['required', 'string', 'in:["1m", "3m", "5m", "15m", "30m", "1h", "2h", "4h", "1d", "1w"]'],
                'open' => ['required', 'numeric', 'min:0'],
                'high' => ['required', 'numeric', 'min:0'],
                'low' => ['required', 'numeric', 'min:0'],
                'close' => ['required', 'numeric', 'min:0'],
                'volume' => ['required', 'numeric', 'min:0'],
                'indicators' => ['array'],
                'other_data' => ['array'],
        ];
    }
}