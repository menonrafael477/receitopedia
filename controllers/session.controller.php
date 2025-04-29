<?php

    class SessionController { 
        public function session_verify() {
            try {
                require('models/login.model.php');
                $usuario = null;
    
                $usuario = get_usuario_por_token(session_id());

                return $usuario->get_id();
            } catch (Exception $e) {
                return(['status' => 'error', 'message' => $e->getMessage()]);
            }
           
        }

        

    }


?>  