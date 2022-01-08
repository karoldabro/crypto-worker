<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UserUpdateRequest",
 *     title="Request for update User entity", 
 *     @OA\Property(property="name", type="string", description="", example=""),
 *     @OA\Property(property="email", type="string", description="", example=""),
 * )
 */
class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [ 
                'name' => ['string'],
                'email' => ['string', 'email'],
        ];
    }
}
