<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Kdabrow\CryptoWorker\Database\Factories\KlineFactory;

/**
 * Class Kline
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property integer $id  
 * @property string $symbol  
 * @property string $exchange_id  
 * @property integer $timestamp  
 * @property string $interval  
 * @property string $open  
 * @property string $high  
 * @property string $low  
 * @property string $close  
 * @property string $volume  
 * @property array $indicators Indicators calculated in strategy 
 * @property array $other_data 
 */
class Kline extends Model
{
    use HasFactory;

    protected $table = 'klines';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected static function newFactory(): KlineFactory
    {
        return KlineFactory::new();
    }

    protected $fillable = [ 
        'symbol', 
        'exchange_id', 
        'timestamp', 
        'interval', 
        'open', 
        'high', 
        'low', 
        'close', 
        'volume', 
        'indicators', 
        'other_data', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
        'timestamp' => 'timestamp', 
        'indicators' => 'array', 
        'other_data' => 'array', 
    ];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}