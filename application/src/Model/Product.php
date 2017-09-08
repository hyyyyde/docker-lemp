<?php

namespace Model;

class Product
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Dao::getInstance()->getPdo();
    }

    /**
     * @return array|null
     */
    public function getAll(): ?array
    {
        $sql = "SELECT * FROM product";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function truncate()
    {
        $sql = "TRUNCATE TABLE product";
        $this->pdo->exec($sql);
    }

    public function create()
    {
        $sql = "CREATE TABLE IF NOT EXISTS product (
          `id` INT AUTO_INCREMENT  NOT NULL PRIMARY KEY,
          `name` VARCHAR(256) NOT NULL
        )";
        $this->pdo->exec($sql);
    }

    public function insert(string $name)
    {
        $sql = "INSERT INTO product (id, name) VALUES (NULL, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $name
        ]);
    }
}
