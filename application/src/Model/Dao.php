<?php

namespace Model;

class Dao
{
    /**
     * @var null|Dao
     */
    private static $instance = null;

    /**
     * @var \PDO
     */
    private $pdo;

    public static function getInstance(): Dao
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    private function __construct()
    {
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            , \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ];

        $dsn = sprintf("mysql:host=%s;dbname=%s", getenv("MYSQL_MASTER_HOST"), getenv("MYSQL_MASTER_DB_NAME"));

        try {
            $this->pdo = new \PDO($dsn, getenv("MYSQL_MASTER_USER"), getenv("MYSQL_MASTER_PASSWORD"), $options);
        } catch (\Exception $e) {
            echo $e->getTraceAsString();
            throw $e;
        }
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
