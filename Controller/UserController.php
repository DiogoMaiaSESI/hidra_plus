<?php

namespace Controller;

require_once __DIR__ . "/../Model/Connection.php";
require_once __DIR__ . "/../Model/User.php";

use Model\User;
use Exception;

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    // REGISTRO DE USUÁRIO
    public function createUser($user_fullname, $email, $password)
    {
        if (empty($user_fullname) || empty($email) || empty($password)) {
            return false;
        }

        // A criptografia da senha agora é feita dentro do Model/User.php
        return $this->userModel->registerUser($user_fullname, $email, $password);
    }

    // LOGIN DE USUÁRIO
    public function loginUser($email, $password)
    {
        if (empty($email) || empty($password)) {
            return false;
        }

        return $this->userModel->loginUser($email, $password);
    }
    public function getUserInfo($id, $user_fullname, $email)
    {
        return $this->userModel->getUserInfo($id, $user_fullname, $email);
    }
}

?>