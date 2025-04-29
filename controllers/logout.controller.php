<?php

    require('models/logoff.model.php');

    class LogoutController {
        public function logoff_user() {
            require('models/login.model.php');
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $usuario = get_usuario_por_token(session_id());
                $id_usuario = $usuario -> get_id();
                
                try {
                    logoff($id_usuario);
                    reset_page();
                    return(['status' => 'success', 'message' => 'Logout bem-sucedido']);
    
                } catch (Exception $e) {
                    return(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                return(['status' => 'error', 'message' => 'Metodo de requisicao invalido.']);
            }
        }
    }

    $logout_controller = new LogoutController();

    if(isset($_GET['action_logoff'])) {
        $action = $_GET['action_logoff'];
    
    echo json_encode("usuario realizou acao");

    //var_dump($_SESSION);
    
    switch ($action) {
        # Login controller
        
        case 'logoff':
            $logout_controller->logoff_user();
            return  (['status' => 'error', 'message' => "Login: '$action'"]);

        default:
            echo json_encode(['status' => 'error', 'message' => "Falha catastrofica: '$action'"]);
    }


    } else {
    return (['status' => 'error', 'message' => 'Acao nao definida']);
}

   