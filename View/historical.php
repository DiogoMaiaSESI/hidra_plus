<?php
session_start();
require_once '../vendor/autoload.php';
use Controller\UserController;
use Controller\watercalcController;
$userController = new UserController();
$waterController = new watercalcController();
$userWaterInfo = $waterController->getUserWater();
$userWaterInfoLastWeek = $waterController->getUserWaterLastWeek();
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
                    <span class="user-name">Nome</span>
                    <span class="user-email">email@example.com</span>
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
                        echo $userWaterInfo;
                    ?> Litros</h2>
                    <div class="status-section">
                        <span class="status-label">Status:</span>
                        <div class="status-buttons">
                            <button class="status-btn">Concluída</button>
                            <button class="status-btn">Não Concluída</button>
                            <button class="status-btn">Em andamento</button>
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
                            <button class="status-btn">Concluída</button>
                            <button class="status-btn">Não Concluída</button>
                            <button class="status-btn">Em andamento</button>
                        </div>
                    </div>
                </section>
                <section class="progress-card">
                    <h2>Meta Semanal atual Anterior: <?php
                        echo $userWaterInfoLastWeek;
                    ?> Litros</h2>
                    <div class="status-section">
                        <span class="status-label">Status:</span>
                        <div class="status-buttons">
                            <button class="status-btn">Concluída</button>
                            <button class="status-btn">Não Concluída</button>
                            <button class="status-btn">Em andamento</button>
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

</body>

</html>