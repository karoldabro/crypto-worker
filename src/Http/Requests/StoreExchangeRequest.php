<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ExchangeStoreRequest",
 *     title="Request for create Exchange entity", 
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="credentials", type="jsonb", description="", example=""),
 * )
 */
class StoreExchangeRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'name' => ['required', 'string'],
                'credentials' => ['required', 'array'],
        ];
    }
}
