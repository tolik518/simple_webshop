<?php
namespace webShop;

class MySQLConnector
{
    private \PDO $connection;

    public function __construct()
    {
        require_once (DATABASE . "config.php");
        try {
            $pdo = new \PDO(DB_DSN, DB_USER, DB_PASS);
            $this->connection = $pdo;
        } catch (\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}