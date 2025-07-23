<?php

session_start();

require_once '../vendor/autoload.php';
use Controller\WatercalcController;
use Controller\UserController;

// CRIANDO UM OBJETO PARA REPRESENTAR CADA IMC CRIADO
$watercalcController = new WatercalcController();
$userController = new UserController();

$waterResult = null;
$userInfo = null;

// VERIFICANDO SE HOUVE LOGIN
if(!$userController->isLoggedIn()){
    header('Location: ../index.php');
    exit();
}

$user_id = $_SESSION['id'];
$user_fullname = $_SESSION['user_fullname'];
$email = $_SESSION['email'];

$userInfo = $userController->getUserData($user_id, $user_fullname, $email);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['weight'])) {
        $weight = $_POST['weight'];
        

        // UTILIZANDO O CONTROLER COMO INTERMEDIÁRIO DA MANIPULAÇÃO E GERENCIAMENTO DE DADOS FRONT/BACK(BANCO DE DADOS)
        $waterResult = $watercalcController->calculateWeight($weight);

        // VERIFICAR SE OS CAMPOS FORAM PREENCHIDOS
        if ($waterResult['BMIrange'] != "O peso  deve conter valores positivos.") {
            $watercalcController->save($weight, $waterResult['water']);
        }
    }
}


?>