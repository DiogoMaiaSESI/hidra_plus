
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


    </div>
    <div class="center">
        <div class="esquerda">
            <div class="title-section">
                <h1>HIDRA+</h1>
                <p>Calcule a sua meta diária de consumo de água. </p>
                <button type="submit" class="Monitoramento">Monitoramento</button>
            </div>
        </div>
        <div class="direita">
            <form method="POST" action="diaryCalc.php">
            <div class="Caixa_Superior">
                <h2>Cálculo</h2>
                <p>Informe o seu peso:</p>
                <input type="number" name="weight" placeholder="Ex: 50.3" id="userWeight">
                <button type="submit">Calcular</button>
        </form>
            </div>
            <div class="Caixa_Inferior">
                <h2>Resultado</h2>
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

</body>

</html>