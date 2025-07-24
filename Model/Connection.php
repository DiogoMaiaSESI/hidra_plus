<?php

namespace Model;

use PDO;
use PDOException;

class Connection
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        // Carrega as configurações do banco de dados
        require_once __DIR__ . "/../Config/configuration.php";

        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8";

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance->pdo;
    }
}

?>