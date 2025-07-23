<?php
require_once('../vendor/autoload.php');

use Controller\UserController;

$user = new UserController();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['user_fullname'],$_POST['email'],$_POST['password'])) {
        $user_fullname = $_POST['user_fullname'];
        $user_email = $_POST['email'];
        $user_password = $_POST['password'];
        $user->registerUser($user_fullname,$user_email, $user_password);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HIDRA+ / Register</title>
        <link rel="stylesheet" href="../templates/assets/css/register.css">
    </head>
    <body>
        <div class="grayline"></div>
        <figure class="logo">
            <img src="../templates/assets/img/logoHidraPlus.png" alt="Logo for HIDRA Plus featuring stylized blue water droplets arranged in a circular pattern with the text HIDRA Plus below in bold modern font on a white background, conveying a fresh and welcoming atmosphere">
        </figure>
        <div class="container">
            <div class="info">
                <h1>HIDRA+</h1>
                <div class="line"></div>
                <h2 class="infoText">Junte-se a quem não esquece da água</h2>
                <figure class="stars">
                    <img src="../templates/assets/img/stars.png" alt="Five yellow stars evenly spaced in a row on a transparent background, representing a five star rating, conveying a positive and welcoming tone">
                </figure>                 
            </div>
            <form method="POST">
                <h2 class="formTitle">CADASTRO</h2>
                <div class="groupLabel">
                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="groupLabel">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="groupLabel">
                    <label for="password">Senha</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="groupLabel">
                    <label for="confirm_password">Confirmar Senha</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <button type="submit">Cadastrar</button>
                <p>Já tem uma conta? <a href="../index.php">Login</a></p>
            </form>
        </div>
    </body>
</html>