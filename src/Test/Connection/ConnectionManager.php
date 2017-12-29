<?php
/**
 * @author : Ugurkan Kaya
 * @date   : 29.12.2017
 */

namespace Container\Test\Connection;

class ConnectionManager
{
    /**
     * @var $connection
     */
    protected $connection;

    /**
     * @var $connectionHost
     */
    protected $connectionHost;

    /**
     * @var $connectionPort
     */
    protected $connectionPort;

    /**
     * @var $connectionUsername
     */
    protected $connectionUsername;

    /**
     * @var $connectionPassword
     */
    protected $connectionPassword;

    /**
     * @var $connectionDatabase
     */
    protected $connectionDatabase;

    /**
     * Build the __construct()
     * @param Connection $connection
     * @param $connectionHost
     * @param $connectionPort
     * @param $connectionUsername
     * @param $connectionPassword
     * @param $connectionDatabase
     */
    public function __construct(Connection $connection, $connectionHost, $connectionPort, $connectionUsername, $connectionPassword, $connectionDatabase)
    {
        $this->setConnection($connection);

        $this->setHost($connectionHost);

        $this->setPort($connectionPort);

        $this->setUsername($connectionUsername);

        $this->setPassword($connectionPassword);

        $this->setDatabase($connectionDatabase);
    }

    protected function setConnection($connection)
    {
        $this->connection = $connection;
    }

    protected function setHost($connectionHost)
    {
        $this->connectionHost = $connectionHost;
    }

    protected function setPort($connectionPort)
    {
        $this->connectionPort = $connectionPort;
    }

    protected function setUsername($connectionUsername)
    {
        $this->connectionUsername = $connectionUsername;
    }

    protected function setPassword($connectionPassword)
    {
        $this->connectionPassword = $connectionPassword;
    }

    protected function setDatabase($connectionDatabase)
    {
        $this->connectionDatabase = $connectionDatabase;
    }

    public function getConnection(): Connection
    {
        return $this->connection;
    }
}