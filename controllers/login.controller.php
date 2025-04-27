<?php

require('models/login.model.php');
require('views/login.view.php');

class LoginController {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            try {
                $token = login($email, $senha);

                #setcookie('cookie', $token, time() + 60 * 60 * 24, '', '', false, true); 

                header('Location: index.php');
                return(['status' => 'success', 'token' => $token]);
            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function logoff() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_usuario'] ?? '';

            try {
                $resultado = logoff($id_usuario);

                return(['status' => 'success', 'message' => 'Logout bem-sucedido']);

            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function verificarToken() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'] ?? '';

            try {
                $isValid = verificar_token($token);

                if ($isValid) {
                    return(['status' => 'success', 'message' => 'Token válido']);
                } else {
                    return(['status' => 'error', 'message' => 'Token inválido']);
                }

            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }
}

$controller = new LoginController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'login':
            echo json_encode($controller->login());
            break;

        case 'logoff':
            $controller->logoff();
            break;

        case 'verificarToken':
            $controller->verificarToken();
            break;

        default:
            return(['status' => 'error', 'message' => 'Ação inválida']);
    }
} else {
    return(['status' => 'error', 'message' => 'Ação não definida']);
}

?> 