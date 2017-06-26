<?php
declare(strict_types=1);

namespace msales\RethinkTest\RethinkDB;

use r;
use r\Connection;
use r\Queries\Dbs\Db;
use r\Queries\Tables\Table;
use \Exception;

class RethinkDB
{
    /** @var Connection[] */
    private $connections = [];

    /**
     * @param null $optsOrHost
     * @param null $port
     * @param null $db
     * @param null $apiKey
     * @param null $timeout
     *
     * @return int Connection ID
     */
    public function connect($optsOrHost = null, $port = null, $db = null, $apiKey = null, $timeout = null): int
    {
        $this->connections[] = r\connect($optsOrHost, $port, $db, $apiKey, $timeout);

        return $this->getLastConnectionId();
    }

    /**
     * @return int
     */
    private function getLastConnectionId(): int
    {
        $connectionsIds = array_keys($this->connections);

        return end($connectionsIds);
    }

    /**
     * @param int $connectionId
     *
     * @return Connection
     * @throws Exception
     */
    public function getConnection(int $connectionId = 0): Connection
    {
        if (!isset($this->connections[$connectionId])) {
            throw new Exception(sprintf('Connection ID "%d" does not exist!', $connectionId));
        }

        return $this->connections[$connectionId];
    }

    /**
     * @param string $table
     *
     * @return Db
     */
    public function db(string $table): Db
    {
        return r\db($table);
    }

    /**
     * @param string $tableName
     * @param null   $useOutdatedOrOpts
     *
     * @return Table
     */
    public function table(string $tableName, $useOutdatedOrOpts = null): Table
    {
        return r\table($tableName, $useOutdatedOrOpts);
    }
}
