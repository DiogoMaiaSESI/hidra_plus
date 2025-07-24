<?php
namespace Model;
use PDO;
use PDOException;
require_once __DIR__ . "/../Config/configuration.php";
class Connection {
    private static $conn;
    public static function getInstance () {
        try {
            if (empty(self::$conn)){
                self::$conn = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname='. DB_NAME . '', DB_USER , DB_PASSWORD);
            }
        } catch (PDOException $error) {
           die ("Erro ao estabelecer conexão: " . $error->getMessage());
        }
        return self::$conn;
    }
}
?>
