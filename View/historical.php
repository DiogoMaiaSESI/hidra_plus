<?php

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
    <figure><img src="../templates/Linha_Lateral.png" alt=""></figure>
    <div class="dashboard-container">
        <header class="main-header">
            <div class="user-info">
                <img src="../templates/Perfil.png" alt="Ícone do Usuário" class="user-icon"> <!-- Troque pelo link do seu ícone -->
                <div class="user-details">
                    <span class="user-name">Nome</span>
                    <span class="user-email">email@example.com</span>
                </div>
            </div>
            <div class="logo-container">
                <img src="../templates/Logo_Hidra.png" alt="Logo Hidra+" class="logo-image"> <!-- Troque pelo link da sua logo -->
            </div>
        </header>

        <div class="title-section">
            <h1>HIDRA+</h1>
            <p>Visualize o seu progresso</p>
        </div>

        <section class="progress-card">
            <h2>Meta diária: xx Litros</h2>
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
            <h2>Meta Semanal atual: xx Litros</h2>
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
            <h2>Meta Semanal atual Anterior: xx Litros</h2>
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
