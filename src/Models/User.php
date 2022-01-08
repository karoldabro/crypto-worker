<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Database\Factories\UserFactory;

/**
 * Class User
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id 
 * @property string $name 
 * @property string $email 
 * @property string $email_verified_at 
 * @property string $password
 */
class User extends Authenticatable
{
    use HasFactory, GeneratesUuid, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'name', 
        'email', 
        'email_verified_at', 
        'password', 
    ];

    protected $hidden = [ 
        'email_verified_at', 
        'password', 
    ];

    protected $casts = [ 
    ];

}
