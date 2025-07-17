<?php

namespace Controller;

use Model\User;
use Exception;

class UserController {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    //REGISTRO DE USUARIO 
    public function registerUser($user_fullname, $email, $password) {
        try {
            if (empty($user_fullname) or empty($email) or empty($password)) {
              return false;
            }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); 

        return $this->userModel->registerUser($user_fullname, $email, $hashedPassword);
        
        } catch (Exception $error) {
            echo "Erro ao cadastrar o usuário: " . $error->getMessage();
            return false;

        } 
    }

    //E-MAIL já CADASTRADO?
    public function checkUsertByEmail($email){
        return $this->userModel->getUserByEmail($email);
    }
        
 // LOGIN DE USUÁRIO
    public function login($email, $password) {
        $user = $this->userModel->getUserByEmail($email);

        /**
         * $user = [
         *  "id": 1,    
         * "user_fullname": " Teste",
         * "email": =>"Teste@example"
         * password": "hashed_password_here"
         */
        if($user && password_verify($password, $user['password'])) {
            if(crypt($password, $user['password']) ){ 
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_fullname'] = $user['user_fullname'];
                $_SESSION['email'] = $user['email'];

                return true;

            } else {
                return false;
            }
        } return false;
       
    }

    // USUÁRIO LOGADO?
    public function isUserLoggedIn() {
        return isset($_SESSION['id']);
    }

// RESGATAR DADOS DO USUÁRIO
public function getUserData($id, $user_fullname, $email) 
{
    return $this->userModel->getUserInfo($id, $user_fullname, $email);
}
}
?>