<?php

namespace Arrilot\BitrixDataAnonymization;

use Arrilot\DataAnonymization\Database\SqlDatabase;
use Bitrix\Main\Config\Configuration;
use Bitrix\Main\DB\Exception;

class Database extends SqlDatabase
{
    /**
     * Constructor.
     *
     * @param string $connectionName
     * @throws Exception
     */
    public function __construct($connectionName = 'default')
    {
        $connections = Configuration::getInstance()->get('connections');

        if (!array_key_exists($connectionName, $connections)) {
            throw new Exception("Connection '$connectionName' is not found in .settings.php");
        }

        $connection = $connections[$connectionName];

        parent::__construct(
            "mysql:dbname={$connection['database']};host={$connection['host']}",
            $connection['login'],
            $connection['password']
        );
    }
}
