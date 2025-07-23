<?php

namespace Model;

use PDO;
use PDOException;
use Model\Connection;

class waterCalc {
    private $db; 

    public function __construct() {
        $this->db = Connection::getInstance();
    }

    public function tabWater($weight,$result) {
        try {
           $sql = "INSERT INTO watercalc (weight, result, created_at)
           VALUES (:weight, :result, NOW())"; 

           $stmt = $this->db->prepare($sql);

           $stmt->bindParam(":weight", $weight, PDO::PARAM_STR);
           $stmt->bindParam(":result", $result, PDO::PARAM_STR);

           return $stmt->execute();

        }

        catch(PDOException $error) {
            echo "Erro : " . $error->getMessage();
            return false;
        }
    }
}


?>