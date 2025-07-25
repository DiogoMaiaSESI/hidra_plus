<?php
session_start();
require_once '../vendor/autoload.php';
use Controller\UserController;
use Controller\watercalcController;
$userController = new UserController();
$waterController = new watercalcController();
$userWaterInfo = $waterController->getUserWater();
$userWaterInfoLastWeek = $waterController->getUserWaterLastWeek();

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

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progresso - Hidra+</title>
    <link rel="stylesheet" href="../templates/assets/css/historical.css">
</head>

<body>
    <figure><img src="../templates/assets/img/Linha_Lateral.png" alt="" class="Linha"></figure>
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

        <div class="title-section">
            <h1>HIDRA+</h1>
            <p>Visualize o seu progresso</p>
        </div>
        <div class="Conteudo">
            <div class="cards">


                <section class="progress-card">
                    <h2>Meta diária: <?php
                        echo $userWaterInfo*1;
                    ?> Litros</h2>
                    <div class="status-section">
                        <span class="status-label">Status:</span>
                        <div class="status-buttons">
                            <button class="status-btn" id="btnstatus1">Concluída</button>
                            <button class="status-btn" id="btnstatus2">Não Concluída</button>
                            <button class="status-btn" id="btnstatus3">Em andamento</button>
                        </div>
                    </div>
                </section>

                <section class="progress-card">
                    <h2>Meta Semanal atual: <?php
                        echo $userWaterInfo*7;
                    ?> Litros</h2>
                    <div class="status-section">
                        <span class="status-label">Status:</span>
                        <div class="status-buttons">
                            <button class="status-btn" id="btnstatus4">Concluída</button>
                            <button class="status-btn" id="btnstatus5">Não Concluída</button>
                            <button class="status-btn" id="btnstatus6">Em andamento</button>
                        </div>
                    </div>
                </section>
                <section class="progress-card">
                    <h2>Meta Semanal atual Anterior: <?php
                        echo $userWaterInfoLastWeek*7;
                    ?> Litros</h2>
                    <div class="status-section">
                        <span class="status-label">Status:</span>
                        <div class="status-buttons">
                            <button class="status-btn" id="btnstatus7">Concluída</button>
                            <button class="status-btn" id="btnstatus8">Não Concluída</button>
                            <button class="status-btn" id="btnstatus9">Em andamento</button>
                        </div>
                    </div>
                </section>
            </div>
            <div class="Dicas">
                <section class="tips-section">
                    <h2>Dicas</h2>
                    <ul class="tips-list">
                        <li>1. Beba água regularmente ao longo do dia.</li>
                        <li>2. Mantenha uma garrafinha de água sempre por perto.</li>
                        <li>3. Defina lembretes para beber água.</li>
                        <li>4. Consuma alimentos ricos em água, como frutas e vegetais.</li>
                    </ul>
                </section>
            </div>
        </div>

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
    <script src="../templates/assets/js/historical.js"></script>
</body>

</html>