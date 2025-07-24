<?php

namespace Controller;

require "../Model/Connection.php";
require "../Model/User.php";

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

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->userModel->registerUser($user_fullname, $email, $password);
    }
}

?>