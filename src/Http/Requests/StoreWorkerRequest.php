<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="WorkerStoreRequest",
 *     title="Request for create Worker entity", 
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class StoreWorkerRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'strategy_id' => ['required', 'uuid', 'exists:strategies,id'],
                'exchange_id' => ['required', 'uuid', 'exists:exchanges,id'],
                'pair' => ['required', 'string'],
                'kandle_interval' => ['sometimes', 'nullable', 'string'],
                'refresh_interval' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
