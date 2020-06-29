<?php

namespace Main\Database\DatabaseBuilder;

use Main\Database\Connection;
use Main\Http\Exceptions\AppException;
use Main\Supports\Traits\MigrateBuilder;

class Schema
{
    use MigrateBuilder;

    public $table;
    public $columns;
    public $flagCreate = false;

    public function __construct()
    {
        $this->compile = new Compile();
        $this->connection = (new Connection)->getConnection();
    }

    public static function __callStatic($method, $arguments)
    {
        switch ($method) {
            case 'create':
                list($table, $columns) = $arguments;
                return (new self)->createMigrate($table, $columns);
            case 'createIfNotExists':
                list($table, $columns) = $arguments;
                return (new self)->createIfNotExistsMigrate($table, $columns);
            case 'drop':
                list($table) = $arguments;
                return (new self)->dropMigrate($table);
            case 'dropIfExists':
                list($table) = $arguments;
                return (new self)->dropIfExistsMigrate($table);
            case 'truncate':
                list($table) = $arguments;
                return (new self)->truncateMigrate($table);
            default:
                throw new AppException("Method '$method' is not supported.");
        }
    }
}