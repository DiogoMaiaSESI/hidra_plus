<?php
session_start();

require_once '../vendor/autoload.php';
use Controller\WatercalcController;
use Controller\UserController;

$watercalcController = new WatercalcController();
$userController = new UserController();

$waterResult = null;
$userInfo = null;


// VERIFICANDO SE HOUVE LOGIN
// if(!$userController->isLoggedIn()){
//     header('Location: ../index.php');
//     exit();
// }

// $user_id = $_SESSION['id'];
// $user_fullname = $_SESSION['user_fullname'];
// $email = $_SESSION['email'];

// $userInfo = $userController->getUserData($user_id, $user_fullname, $email);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['weight'])) {
        $weight = $_POST['weight'];
       

        // UTILIZANDO O CONTROLER COMO INTERMEDIÁRIO DA MANIPULAÇÃO E GERENCIAMENTO DE DADOS FRONT/BACK(BANCO DE DADOS)
        $waterResult = $watercalcController->calculateWeight($weight);

        // VERIFICAR SE OS CAMPOS FORAM PREENCHIDOS
        if ($waterResult!= "O peso deve conter valores positivos." and $waterResult!="Por favor, informe o peso para obter o seu consumo diário de água.") {
            $watercalcController->save($weight, $waterResult['water']);
        }
    }
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_fullname = $_SESSION['user_fullname'];
    $email = $_SESSION['user_email'];

    // BUSCANDO INFORMAÇÕES DO USUÁRIO
    $userInfo = $userController->getUserInfo($user_id, $user_fullname, $email);
} else {
    header('Location: ../index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Progresso - Hidra+</title>
        <link rel="stylesheet" href="../templates/assets/css/diaryCalc.css">
    </head>
    <body>
        <div class="dashboard-container">
            <header class="main-header">
                <div class="user-info">
                    <img src="../templates/assets/img/Perfil.png" alt="Ícone do Usuário" class="user-icon">
                    <div class="user-details">
                        <span class="user-name"><?php echo htmlspecialchars($user_fullname); ?></span>
                        <span class="user-email"><?php echo htmlspecialchars($email); ?></span>
                    </div>
                </div>
                <div class="logo-container">
                    <img src="../templates/assets/img/Logo_Hidra.png" alt="Logo Hidra+" class="logo-image">
                </div>
            </header>
        </div>
        <div class="center">
            <div class="esquerda">
                <div class="title-section">
                    <h1>HIDRA+</h1>
                    <p>Calcule a sua meta diária de consumo de água. </p>
                    <button class="Monitoramento" id="Monitoramento">Monitoramento</button>
                </div>
            </div>
            <div class="direita">
                <form method="POST" action="diaryCalc.php">
                <div class="Caixa_Superior">
                    <h2>Cálculo</h2>
                    <p>Informe o seu peso:</p>
                    <input type="number" step="any" name="weight" placeholder="Ex: 50.3" id="userWeight">
                    <button type="submit">Calcular</button>
            </form>
                </div>
                <div class="Caixa_Inferior">
                    <h2>Resultado<br><span><?php
                    if(isset($waterResult)){
                        echo "O consumo diário adequado de água é: ".$waterResult["water"]." litros";
                    } else {
                        echo "Sem resultado";
                    }
                    ?></span></h2>
                </div>
            </div>
        </div>
        <figure class="Linha">
            <img src="../templates/assets/img/Linha_Lateral.png" alt="Vertical decorative line with a blue gradient, used as a visual divider between sections on a clean and modern web dashboard interface" class="Linha">
        </figure>
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
        <script>
            console.log(window.innerWidth);
        </script>
        <script src="../templates/assets/js/diaryCalc.js"></script>
    </body>
</html>