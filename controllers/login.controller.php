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

                return(['status' => 'success', 'id' => $token]);
            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }
}

$login_controller = new LoginController();

if(isset($_GET['action_login'])) {
    $action = $_GET['action_login'];
    
    echo json_encode("usuario realizou acao");

    //var_dump($_SESSION);
    
    switch ($action) {
        # Login controller
        
        case 'login':
            $login_controller->login_usuario();
            return  (['status' => 'error', 'message' => "Login: '$action'"]);

        default:
            echo json_encode(['status' => 'error', 'message' => "Falha catastrofica: '$action'"]);
    }

    } else {
    return (['status' => 'error', 'message' => 'Acao nao definida']);
}
?> 