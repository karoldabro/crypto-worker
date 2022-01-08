<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="StrategyStoreRequest",
 *     title="Request for create Strategy entity", 
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="kandle_interval", type="string", description="", example=""),
 *     @OA\Property(property="refresh_interval", type="string", description="", example=""),
 * )
 */
class StoreStrategyRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'name' => ['required', 'string', 'max:150'],
                'kandle_interval' => ['required', 'string'],
                'refresh_interval' => ['required', 'string'],
        ];
    }
}
