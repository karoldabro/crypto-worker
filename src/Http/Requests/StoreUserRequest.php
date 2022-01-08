<?php

namespace Kdabrow\CryptoWorker\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *     schema="UserStoreRequest",
 *     title="Request for create User entity", 
 *     @OA\Property(property="name", type="string", description="User name", example=""),
 *     @OA\Property(property="email", type="string", description="User email address", example=""),
 *     @OA\Property(property="password", type="string", description="", example=""),
 * )
 */
class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['string', 'required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ];
    }
}
