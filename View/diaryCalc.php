<?php
session_start();

require_once '../vendor/autoload.php';
use Controller\WatercalcController;
use Controller\UserController;

$watercalcController = new WatercalcController();
$userController = new UserController();

$waterResult = null;
$userInfo = null;

if (isset($_GET["id"])) {
    $user_id_from_get = $_GET["id"];

    // Busca as informações do usuário usando o novo método getUserById
    $userInfo = $userController->getUserById($user_id_from_get);

    // Se o usuário não for encontrado ou o ID da sessão não corresponder (segurança)
    if (!$userInfo || (isset($_SESSION["user_id"]) && $_SESSION["user_id"] != $user_id_from_get)) {
        // Redireciona para a página de login se o ID não for válido ou não corresponder à sessão
        header("Location: ../index.php");
        exit();
    }

    // Atualiza as variáveis de sessão com os dados obtidos via GET para manter o contexto
    $_SESSION["user_id"] = $userInfo["id"];
    $_SESSION["user_fullname"] = $userInfo["user_fullname"];
    $_SESSION["user_email"] = $userInfo["email"];

} else if (isset($_SESSION["user_id"])) {
    // Se não houver ID na URL, mas houver na sessão, usa os dados da sessão
    $user_id_from_session = $_SESSION["user_id"];
    $userInfo = $userController->getUserById($user_id_from_session);

    if (!$userInfo) {
        // Se o usuário da sessão não for encontrado no BD, destrói a sessão e redireciona
        session_destroy();
        header("Location: ../index.php");
        exit();
    }
} else {
    // Se não houver ID na URL nem na sessão, redireciona para o login
    header("Location: ../index.php");
    exit();
}

// Define as variáveis para exibição no HTML
$user_fullname = $userInfo["user_fullname"] ?? "";
$email = $userInfo["email"] ?? "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['weight'])) {
        $weight = $_POST['weight'];


        // UTILIZANDO O CONTROLER COMO INTERMEDIÁRIO DA MANIPULAÇÃO E GERENCIAMENTO DE DADOS FRONT/BACK(BANCO DE DADOS)
        $waterResult = $watercalcController->calculateWeight($weight);

        // VERIFICAR SE OS CAMPOS FORAM PREENCHIDOS
        if ($waterResult != "O peso deve conter valores positivos." and $waterResult != "Por favor, informe o peso para obter o seu consumo diário de água.") {
            $watercalcController->save($weight, $waterResult['water']);
        }
    }
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
                <a href="../index.php" class="nav-button exit-button">Sair</a>
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
            if (isset($waterResult)) {
                if (is_array($waterResult) && isset($waterResult["water"])) {
                    echo "O consumo diário adequado de água é: " . $waterResult["water"] . " litros";
                } else {
                    echo $waterResult;
                }
            } else {
                echo "Sem resultado";
            }
            ?></span></h2>
        </div>
    </div>
    </div>
    <figure class="Linha">
        <img src="../templates/assets/img/Linha_Lateral.png"
            alt="Vertical decorative line with a blue gradient, used as a visual divider between sections on a clean and modern web dashboard interface"
            class="Linha">
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