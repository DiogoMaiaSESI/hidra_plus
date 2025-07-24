<?php

namespace Model;

use Model\Connection;
use PDO;
use PDOException;
use Exception;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    // FUNÇÃO DE CRIAR USUÁRIO
    public function registerUser($user_fullname, $email, $password)
    {
        try {
            // INSERÇÃO DE DADOS NA LINGUAGEM SQL
            $sql = 'INSERT INTO user (user_fullname, email, password, created_at) VALUES (:user_fullname, :email, :password, NOW())';

            // PREPARAR A QUERY
            $stmt = $this->db->prepare($sql);

            // VINCULAR OS PARÂMETROS
            $stmt->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password, PDO::PARAM_STR);

            // EXECUTAR TUDO
            return $stmt->execute();
        } catch (PDOException $error) {
            // EXIBIR MENSAGEM DE ERRO COMPLETA E PARAR A EXECUÇÃO
            throw new Exception("Erro ao cadastrar usuário: " . $error->getMessage());
        }
    }

    // LOGIN
    public function getUserByEmail($email)
    {
        try {
            $sql = "SELECT * FROM user WHERE email = :email LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new Exception("Erro ao buscar usuário por email: " . $error->getMessage());
        }
    }

    // OBTER INFORMAÇÕES DO USUÁRIO
    public function getUserInfo($id, $user_fullname, $email)
    {
        try {
            $sql = "SELECT user_fullname, email FROM user WHERE id = :id AND user_fullname = :user_fullname AND email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $error) {
            throw new Exception("Erro ao obter informações do usuário: " . $error->getMessage());
        }
    }
}

?>
