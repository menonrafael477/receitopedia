<?php

    //require_once('models/login.model.php');

    class SessionController { 
        public function session_verify() {
            $usuario = null;

            try {
                $usuario = get_usuario_por_token(session_id());
            } catch (Exception $erro){
                echo "Nao foi possivel detectar login";
            }

            if ($usuario != null) {
                echo "O usuario existe, logo posso me logar automaticamente";
                
                return;
            }

            echo "Nao foi possível detectar o login, usuário nao existe";
        }

    }


?>  