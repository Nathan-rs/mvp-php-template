<?php

namespace App\Core;

use PDO;
use PDOException;

class Database
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO('sqlite:' . __DIR__ . "/../data/example_database.sqlite");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro ao estabelecer conexão com o banco de dados: " . $e->getMessage();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
