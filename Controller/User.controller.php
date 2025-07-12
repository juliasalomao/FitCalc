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
        
        
      

    // LOGIN DO USURIO
    public function loginUser($email, $password) {
        $user = $this->userModel->getUserByEmail($email);


            if($User)
            if ( crypt $user && password_verify($password, $user['password'])) {
                return $user; // Usuário autenticado com sucesso
            } else {
                return false; // Credenciais inválidas
            }
        } catch (Exception $error) {
            echo "Erro ao fazer login: " . $error->getMessage();
            return false;
        }
    }

    //USUARIO LOGADO?

    //RESGATAR DADOS DO USUARIO

}
?>