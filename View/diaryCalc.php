<?php

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
                <img src="../templates/Perfil.png" alt="Ícone do Usuário" class="user-icon">
                <div class="user-details">
                    <span class="user-name">Nome</span>
                    <span class="user-email">email@example.com</span>
                </div>
            </div>
            <div class="logo-container">
                <img src="../templates/Logo_Hidra.png" alt="Logo Hidra+" class="logo-image">
            </div>
        </header>


    </div>
    <div class="center">
        <div class="esquerda">
            <div class="title-section">
                <h1>HIDRA+</h1>
                <p>Calcule a sua meta diária de consumo de água. </p>
                <button class="Monitoramento">Monitoramento</button>
            </div>
        </div>
        <div class="direita">
            <div class="Caixa_Superior">
                <h2>Cálculo</h2>
                <p>Informe o seu peso:</p>
                <input type="number">
                <button>Calcular

                </button>
            </div>
            <div class="Caixa_Inferior">
                <h2>Resultado</h2>
                

            </div>
        </div>

    </div>
<figure class="Linha" ><img src="../templates/Linha_Lateral.png" alt="" class="Linha" ></figure>




























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