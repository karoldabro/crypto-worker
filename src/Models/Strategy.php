<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Database\Factories\StrategyFactory;

/**
 * Class Strategy
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id 
 * @property string $name 
 * @property string $kandle_interval 
 * @property string $refresh_interval
 */
class Strategy extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'strategies';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): StrategyFactory
    {
        return StrategyFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'name', 
        'kandle_interval', 
        'refresh_interval', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
    ];

    public function worker()
    {
        return $this->hasMany(Worker::class);
    }
}
