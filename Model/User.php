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
            // Verificar se o email já existe
            if ($this->getUserByEmail($email)) {
                throw new Exception("Este email já está cadastrado.");
            }

            // Criptografar a senha
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // INSERÇÃO DE DADOS NA LINGUAGEM SQL
            // Removido 'id' da query, pois é auto-incrementado no banco de dados
            $sql = 'INSERT INTO user (user_fullname, email, password, created_at) VALUES (:user_fullname, :email, :password, NOW())';

            // PREPARAR A QUERY
            $stmt = $this->db->prepare($sql);

            // VINCULAR OS PARÂMETROS
            $stmt->bindParam(':user_fullname', $user_fullname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR); // Usar a senha criptografada

            // EXECUTAR TUDO
            return $stmt->execute();
        } catch (PDOException $error) {
            // EXIBIR MENSAGEM DE ERRO COMPLETA E PARAR A EXECUÇÃO
            throw new Exception("Erro ao cadastrar usuário: " . $error->getMessage());
        } catch (Exception $e) {
            throw $e; // Re-lança a exceção de email já cadastrado
        }
    }

    // FUNÇÃO DE LOGIN
    public function loginUser($email, $password)
    {
        try {
            $user = $this->getUserByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                // Senha correta, retorna os dados do usuário (sem a senha hash)
                unset($user['password']);
                return $user;
            } else {
                return false; // Email ou senha incorretos
            }
        } catch (PDOException $error) {
            throw new Exception("Erro ao tentar fazer login: " . $error->getMessage());
        }
    }

    // FUNÇÃO PARA BUSCAR USUÁRIO POR EMAIL (usada internamente e para login)
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

    // OBTER INFORMAÇÕES DO USUÁRIO (mantido, mas pode ser ajustado conforme necessidade)
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
