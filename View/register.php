<?php
session_start();
require_once '../Controller/UserController.php';

$userController = new UserController();
$errors = [];
$success = '';

// Processa o formulário quando enviado via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    $result = $userController->register($fullname, $email, $password, $confirmPassword);

    if ($result['success']) {
        $success = $result['message'];
        // Opcional: redirecionar para página de login após sucesso
        // header('Location: login.php');
        // exit;
    } else {
        $errors = $result['errors'];
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
            <form>
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
                <?php if (!empty($errors)): ?>
                    <div class="error-messages">
                        <?php foreach ($errors as $error): ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($success)): ?>
                    <div class="success-message">
                        <p><?php echo $success; ?></p>
                    </div>
                <?php endif; ?>
                <p>Já tem uma conta? <a href="../index.php">Login</a></p>
            </form>
        </div>
    </body>
</html>