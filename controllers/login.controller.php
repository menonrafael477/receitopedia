<?php

require('models/login.model.php');
require('views/login.view.php');

class LoginController {

    public function login_usuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            try {
                $token = login($email, $senha, session_id());

                #setcookie('cookie', $token, time() + 60 * 60 * 24, '', '', false, true); 

                //header('Location: index.php');
                return(['status' => 'success', 'token' => $token]);
            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }
}

?> 