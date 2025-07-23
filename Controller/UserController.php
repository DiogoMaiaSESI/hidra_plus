<?php

require_once '../Config/configuration.php';

class UserController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    /**
     * Registra um novo usuário no sistema
     * @param string $fullname Nome completo do usuário
     * @param string $email Email do usuário
     * @param string $password Senha do usuário
     * @param string $confirmPassword Confirmação da senha
     * @return array Resultado da operação
     */
    public function register($fullname, $email, $password, $confirmPassword) {
        // Array para armazenar erros de validação
        $errors = [];

        // Validação do nome completo
        if (empty($fullname)) {
            $errors[] = "O nome completo é obrigatório.";
        } elseif (strlen($fullname) < 2) {
            $errors[] = "O nome deve ter pelo menos 2 caracteres.";
        } elseif (strlen($fullname) > 100) {
            $errors[] = "O nome não pode ter mais de 100 caracteres.";
        }

        // Validação do email
        if (empty($email)) {
            $errors[] = "O email é obrigatório.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "O email informado não é válido.";
        } elseif (strlen($email) > 150) {
            $errors[] = "O email não pode ter mais de 150 caracteres.";
        }

        // Validação da senha
        if (empty($password)) {
            $errors[] = "A senha é obrigatória.";
        } elseif (strlen($password) < 6) {
            $errors[] = "A senha deve ter pelo menos 6 caracteres.";
        } elseif (strlen($password) > 255) {
            $errors[] = "A senha não pode ter mais de 255 caracteres.";
        }

        // Validação da confirmação de senha
        if (empty($confirmPassword)) {
            $errors[] = "A confirmação de senha é obrigatória.";
        } elseif ($password !== $confirmPassword) {
            $errors[] = "As senhas não coincidem.";
        }

        // Se há erros de validação, retorna os erros
        if (!empty($errors)) {
            return [
                'success' => false,
                'errors' => $errors
            ];
        }

        // Verifica se o email já está cadastrado
        if ($this->emailExists($email)) {
            return [
                'success' => false,
                'errors' => ['Este email já está cadastrado no sistema.']
            ];
        }

        // Criptografa a senha
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        try {
            // Prepara a query de inserção
            $stmt = $this->pdo->prepare("
                INSERT INTO users (user_fullname, email, password, created_at) 
                VALUES (:fullname, :email, :password, NOW())
            ");

            // Executa a inserção
            $result = $stmt->execute([
                ':fullname' => trim($fullname),
                ':email' => trim(strtolower($email)),
                ':password' => $hashedPassword
            ]);

            if ($result) {
                return [
                    'success' => true,
                    'message' => 'Usuário cadastrado com sucesso!',
                    'user_id' => $this->pdo->lastInsertId()
                ];
            } else {
                return [
                    'success' => false,
                    'errors' => ['Erro interno do servidor. Tente novamente.']
                ];
            }

        } catch (PDOException $e) {
            // Log do erro (em produção, use um sistema de log adequado)
            error_log("Erro no registro de usuário: " . $e->getMessage());
            
            return [
                'success' => false,
                'errors' => ['Erro interno do servidor. Tente novamente.']
            ];
        }
    }

    /**
     * Verifica se um email já existe no banco de dados
     * @param string $email Email a ser verificado
     * @return bool True se o email existe, false caso contrário
     */
    private function emailExists($email) {
        try {
            $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE email = :email");
            $stmt->execute([':email' => trim(strtolower($email))]);
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Função para login (implementação futura)
     * @param string $email Email do usuário
     * @param string $password Senha do usuário
     * @return array Resultado da operação
     */
    public function login($email, $password) {
        // TODO: Implementar função de login
        return [
            'success' => false,
            'errors' => ['Função de login ainda não implementada.']
        ];
    }
}

?>