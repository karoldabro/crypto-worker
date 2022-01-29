<?php

namespace Kdabrow\CryptoWorker\Bot\Decision;

use Kdabrow\CryptoWorkerContract\Worker\RepositoryInterface;

class Executor
{
    public function __construct(private RepositoryInterface $repository) 
    {}

    public function execute(Decision $decition): bool
    {
        // check status of order in database (orders in database are update in other process)

        // if order is active execute decision
        
        return true;
    }
}