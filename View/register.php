<?php

use Controller\UserController;

require_once __DIR__ . "/../Config/configuration.php";
require_once __DIR__ . "/../Controller/UserController.php";

$userController = new UserController();

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_fullname = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["senha"] ?? "";
    $confirm_password = $_POST["confirmar_senha"] ?? "";

    // Validação básica (pode ser expandida no UserController)
    if (empty($user_fullname) || empty($email) || empty($password) || empty($confirm_password)) {
        $errors[] = "Todos os campos são obrigatórios.";
    } elseif ($password !== $confirm_password) {
        $errors[] = "As senhas não coincidem.";
    } else {
        try {
            $result = $userController->createUser($user_fullname, $email, $password);

            if ($result) {
                $success = "Usuário cadastrado com sucesso! Redirecionando para o login...";
                header("Location: ../index.php"); // Redirecionar para a página de login
                exit();
            } else {
                $errors[] = "Erro ao cadastrar usuário. Tente novamente.";
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage(); // Captura exceções como email já cadastrado
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HIDRA+ / Cadastro</title>
        <link rel="stylesheet" href="../templates/assets/css/register.css">
    </head>
    <body>
        <div class="linha-cinza"></div>
        <figure class="logotipo">
            <img src="../templates/assets/img/logoHidraPlus.png" alt="Logo para HIDRA Plus com gotas de água estilizadas em azul dispostas em um padrão circular com o texto HIDRA Plus abaixo em fonte moderna e negrito em um fundo branco, transmitindo uma atmosfera fresca e acolhedora">
        </figure>
        <div class="conteudo-principal">
            <div class="informacoes">
                <h1>HIDRA+</h1>
                <div class="linha"></div>
                <h2 class="texto-informacoes">Junte-se a quem não esquece da água</h2>
                <figure class="estrelas">
                    <img src="../templates/assets/img/stars.png" alt="Cinco estrelas amarelas espaçadas uniformemente em uma linha em um fundo transparente, representando uma classificação de cinco estrelas, transmitindo um tom positivo e acolhedor">
                </figure>                 
            </div>
            <form method="POST">
                <h2 class="titulo-formulario">CADASTRO</h2>
                <div class="grupo-campo">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="grupo-campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="grupo-campo">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="grupo-campo">
                    <label for="confirmar_senha">Confirmar Senha</label>
                    <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                </div>
                <button type="submit">Cadastrar</button>
                <?php if (!empty($errors)): ?>
                    <div class="mensagens-erro">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="mensagem-sucesso">
                        <p><?php echo $success; ?></p>
                    </div>
                <?php endif; ?>
                <p>Já tem uma conta? <a href="../index.php">Login</a></p>
            </form>
        </div>
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
                <div class="vw-plugin-top-wrapper"></div>
            </div>
        </div>
        <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
        <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        </script>
    </body>
</html>
