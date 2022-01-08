<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StrategyUpdateRequest",
 *     title="Request for update Strategy entity", 
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class UpdateStrategyRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'name' => ['string', 'max:150'],
                'kandle_interval' => ['string'],
                'refresh_interval' => ['string'],
        ];
    }
}
