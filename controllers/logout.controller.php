<?php

    require('models/logoff.model.php');
    

    class Logout_controller {
        public function logoff_user() {
            require('models/login.model.php');
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                
                $usuario = get_usuario_por_token(session_id());
                $id_usuario = $usuario -> get_id();
                
                try {
                    logoff($id_usuario);
    
                    return(['status' => 'success', 'message' => 'Logout bem-sucedido']);
    
                } catch (Exception $e) {
                    return(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                return(['status' => 'error', 'message' => 'Metodo de requisicao invalido.']);
            }
        }
    }

   