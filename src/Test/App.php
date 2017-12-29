<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

namespace Container\Test;

use Container\Test\Connection\ConnectionManager;

class App
{
    /**
     * @var $connectionManager
     */
    protected $connectionManager;

    public function __construct(ConnectionManager $connectionManager)
    {
        $this->connectionManager = $connectionManager;
    }

    public function getConnectionManager(): ConnectionManager
    {
        return $this->connectionManager;
    }
}