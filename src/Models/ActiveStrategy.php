<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Casts\IntervalCast;
use Kdabrow\CryptoWorker\Database\Factories\ActiveStrategyFactory;
use Kdabrow\CryptoWorker\Models\Traits\HasStrategyConfiguration;
use Kdabrow\CryptoWorkerContract\Worker\ConfigurationInterface;

/**
 * Class ActiveStrategy
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id  
 * @property string $strategy_id  
 * @property string $exchange_id  
 * @property string $pair  
 * @property string $kline_interval Kandle interval 
 * @property integer $kline_quantity How much klines goes to strategy calculation 
 * @property string $refresh_interval How frequently strategy is calculated
 */
class ActiveStrategy extends Model implements ConfigurationInterface
{
    use HasFactory, GeneratesUuid, HasStrategyConfiguration;

    protected $table = 'active_strategies';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): ActiveStrategyFactory
    {
        return ActiveStrategyFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'strategy_id', 
        'exchange_id', 
        'pair', 
        'kline_interval', 
        'kline_quantity', 
        'refresh_interval', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
        'refresh_interval' => IntervalCast::class,
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