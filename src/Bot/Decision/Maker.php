<?php

namespace Kdabrow\CryptoWorker\Bot\Decision;

use Kdabrow\CryptoWorkerContract\Exchange\DataObjects\Order;
use Kdabrow\CryptoWorkerContract\Strategy\StrategyInterface;

class Maker
{
    public function makeDecition(StrategyInterface $strategy, ?Order $activeOrder): Decision
    {
        return new Decition();
    }
}