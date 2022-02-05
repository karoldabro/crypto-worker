<?php

namespace Kdabrow\CryptoWorker\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\GeneratesUuid;
use Kdabrow\CryptoWorker\Database\Factories\OrderFactory;

/**
 * Class Order
 * @package Kdabrow\CryptoWorker\Models
 *  
 * @property string $id  
 * @property string $external_id Id on exchange 
 * @property string $active_strategy_id  
 * @property string $strategy_id  
 * @property string $exchange_id  
 * @property string $status Describes what is happening with order 
 * @property string $symbol  
 * @property string $type  
 * @property string $side Long or Short 
 * @property double $price  
 * @property integer $quantity  
 * @property double $activation_price  
 * @property double $stop_loss  
 * @property string $registered_at When is registered on exchange 
 * @property string $executed_at When is activated at exchange 
 * @property string $closed_at 
 */
class Order extends Model
{
    use HasFactory, GeneratesUuid;

    protected $table = 'orders';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public $timestamps = false;

    protected $keyType = 'string';

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function uuidColumn(): string
    {
        return 'id';
    }

    protected $fillable = [ 
        'id', 
        'external_id', 
        'active_strategy_id', 
        'strategy_id', 
        'exchange_id', 
        'status', 
        'symbol', 
        'type', 
        'side', 
        'price', 
        'quantity', 
        'activation_price', 
        'stop_loss', 
        'registered_at', 
        'executed_at', 
        'closed_at', 
    ];

    protected $hidden = [ 
    ];

    protected $casts = [ 
    ];

    public function active_strategy()
    {
        return $this->belongsTo(ActiveStrategy::class);
    }
    public function strategy()
    {
        return $this->belongsTo(Strategy::class);
    }
    public function exchange()
    {
        return $this->belongsTo(Exchange::class);
    }
}
