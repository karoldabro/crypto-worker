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
 * @property string $pair 
 * @property string $exchange_id 
 * @property integer $timestamp 
 * @property string $interval 
 * @property string $open 
 * @property string $high 
 * @property string $low 
 * @property string $close 
 * @property string $volume
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
        'pair', 
        'exchange_id', 
        'timestamp', 
        'interval', 
        'open', 
        'high', 
        'low', 
        'close', 
        'volume', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
        'timestamp' => 'timestamp', 
    ];

    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}
