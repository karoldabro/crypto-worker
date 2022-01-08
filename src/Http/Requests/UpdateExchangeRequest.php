<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="ExchangeUpdateRequest",
 *     title="Request for update Exchange entity", 
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="credentials", type="jsonb", description="", example=""),
 * )
 */
class UpdateExchangeRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'name' => ['string'],
                'credentials' => ['array'],
        ];
    }
}
