<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="WorkerUpdateRequest",
 *     title="Request for update Worker entity", 
 *     @OA\Property(property="strategy_id", type="uuid", description="", example=""),
 *     @OA\Property(property="exchange_id", type="uuid", description="", example=""),
 *     @OA\Property(property="pair", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class UpdateWorkerRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'strategy_id' => ['uuid', 'exists:strategies,id'],
                'exchange_id' => ['uuid', 'exists:exchanges,id'],
                'pair' => ['string'],
                'kandle_interval' => ['sometimes', 'nullable', 'string'],
                'refresh_interval' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
