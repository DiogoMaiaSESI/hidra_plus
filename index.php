<?php

use Controller\UserController;

require_once "Config/configuration.php";
require_once "Controller/UserController.php";

$userController = new UserController();

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST["email"] ?? "";
    $password = $_POST["senha"] ?? "";

    if (empty($email) || empty($password)) {
        $errors[] = "Email e senha são obrigatórios.";
    } else {
        $user = $userController->loginUser($email, $password);

        if ($user) {
            // Login bem-sucedido
            // Iniciar sessão e armazenar dados do usuário
            session_start();
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["user_fullname"] = $user["user_fullname"];
            $_SESSION["user_email"] = $user["email"];

            $success = "Login realizado com sucesso! Redirecionando...";
            header("Location: View/diaryCalc.php"); // Redirecionar para a página principal após o login
            exit();
        } else {
            $errors[] = "Email ou senha incorretos.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HIDRA+ / Login</title>
        <link rel="stylesheet" href="templates/assets/css/index.css">
    </head>
    <body>
        <div class="linha-cinza"></div>
        <figure class="logotipo">
            <img src="templates/assets/img/logoHidraPlus.png" alt="Logo para HIDRA Plus com gotas de água estilizadas em azul dispostas em um padrão circular com o texto HIDRA Plus abaixo em fonte moderna e negrito em um fundo branco, transmitindo uma atmosfera fresca e acolhedora">
        </figure>
        <div class="conteudo-principal">
            <div class="informacoes">
                <h1>HIDRA+</h1>
                <div class="linha"></div>
                <h2 class="texto-informacoes">Entre no site e transforme hidratação em um hábito fácil!</h2>
            </div>
            <div class="card-hidratado">
                <h3>#TeamHidratado</h3>
                <img src="templates/assets/img/waterCup.png" alt="Copo de água estilizado com rosto feliz">
            </div>
            <form method="POST">
                <h2 class="titulo-formulario">LOGIN</h2>
                <div class="grupo-campo">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="grupo-campo">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <button type="submit">Entrar</button>
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
                <p>Não tem uma conta? <a href="View/register.php">Cadastre-se</a></p>
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
