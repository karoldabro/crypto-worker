<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Database\Factories\WorkerFactory;

/**
 * Class Worker
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id 
 * @property string $strategy_id 
 * @property string $exchange_id 
 * @property string $pair 
 * @property string $kandle_interval 
 * @property string $refresh_interval
 */
class Worker extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'workers';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): WorkerFactory
    {
        return WorkerFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'strategy_id', 
        'exchange_id', 
        'pair', 
        'kandle_interval', 
        'refresh_interval', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
    ];

    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}
