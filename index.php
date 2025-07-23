<?php
require_once 'vendor/autoload.php';

use Controller\UserController;
$userController = new UserController();
$loginMessage = '';

if ($_SERVER['REQUEST_METHOD']== 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($userController->login($email, $password)) {
        header('Location: View/home.php');
        exit();
      
    }else{
        $loginMessage = "Email ou senha incorretos";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>HIDRA+ / Login</title>
        <link rel="stylesheet" href="templates/assets/css/index.css">
    </head>
    <body>
        <div class="grayline"></div>
        <figure class="logo">
            <img src="templates/assets/img/logoHidraPlus.png" alt="Logo for HIDRA Plus featuring stylized blue water droplets arranged in a circular pattern with the text HIDRA Plus below in bold modern font on a white background, conveying a fresh and welcoming atmosphere">
        </figure>
        <div class="container">
            <div class="info">
                <h1>HIDRA+</h1>
                <div class="line"></div>
                <h2 class="infoText">Entre no site e transforme hidratação em um hábito fácil!</h2>               
            </div>
            <div class="cards">
                <div class="card">
                    <h2 class="cardTitle">#TeamHidratado</h2>
                    <figure class="cardImage">
                        <img class="cardImg" src="templates/assets/img/waterCup.png" alt="Glass of water filled to the brim with clear liquid, placed on a clean white surface in a bright and inviting setting, evoking a sense of freshness and hydration">
                    </figure>
                </div>
                <form>
                    <h2 class="formTitle">LOGIN</h2>
                    <div class="groupLabel">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="groupLabel">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit">Entrar</button>
                    <p>Não possui conta? <a href="View/register.php">Cadastre-se</a></p>
                </form>
            </div>
        </div>
    </body>
</html>