<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Database\Factories\ExchangeFactory;

/**
 * Class Exchange
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id 
 * @property string $name 
 * @property string $credentials
 */
class Exchange extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'exchanges';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): ExchangeFactory
    {
        return ExchangeFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'name', 
        'credentials', 
    ];

    protected $hidden = [ 
        'credentials', 
    ];

    protected $casts = [ 
        'credentials' => 'encrypted:array', 
    ];

    public function kline()
    {
        return $this->hasMany(Kline::class);
    }
    public function worker()
    {
        return $this->hasMany(Worker::class);
    }
}
