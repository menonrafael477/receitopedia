<?php
    require('config/db.php');

    # ========= Funções disponíveis ================= #
    # Login
    # Logoff
    # Verificar Token
    # =============================================== #

    function gerar_token() : string{
        return bin2hex(random_bytes(32));
    }

    function inserir_token($banco_de_dados, $id_usuario, $token) {
        try {
            $statement = $banco_de_dados->prepare(
                "INSERT INTO sessions (id_usuario, token_sessao) VALUES (?, ?)"
            );
            $statement->bind_param("is", $id_usuario, $token);
            $statement->execute();

        } catch (Exception $erro) {
            throw new Exception("Não foi possível inserir token no banco de dados, falha no login.");
        }
    } 
    
    function remover_token($banco_de_dados, $id_usuario) {
        try {
            $statement = $banco_de_dados->prepare(
                "DELETE FROM sessions WHERE id_usuario = ?"
            );
            $statement->bind_param("i", $id_usuario);
            $statement->execute();
        } catch (Exception $erro) {
            throw new Exception("Não foi possível remover o token do banco de dados, falha no logoff.");
        }
    }

    function verificar_admin($email, $senha) : bool{
        if ($email == "admin@gmail.com" && $senha == "admin") {
            return true;
        }
        return false;
    }

    function verificar_token(string $token) : bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
    
        try {
            $statement = $banco_de_dados->prepare("SELECT id_usuario FROM token_sessao WHERE id_usuario = ?");
            $statement->bind_param("s", $token);
            $statement->execute();
            $resultado = $statement->get_result();
    
            return ($resultado && $resultado->num_rows > 0);
        } catch (Exception $erro) {
            throw new Exception("Não foi possível verificar o token de acesso, falha na verificação.");
        }
    }

    function login($email, $senha): string {
        if (verificar_admin($email, $senha)) {
            return "admin";
        }
    
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("SELECT id FROM usuario WHERE email = ? AND senha = ?");
        $statement->bind_param("ss", $email, $senha);
        $statement->execute();
        $resultado = $statement->get_result();
    
        if ($resultado && $resultado->num_rows > 0) {
            $token = gerar_token();
            $row   = $resultado->fetch_assoc();
            $id    = $row['id'];
            inserir_token($banco_de_dados, $id, $token);

            $_SESSION['id'] = $id;
            return $token;
        }
    
        throw new Exception("Usuário ou senhas incorretos, falha no login");
    }

    function logoff($id_usuario) : int {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        remover_token($banco_de_dados, $id_usuario);
        return 1;
    }

?>