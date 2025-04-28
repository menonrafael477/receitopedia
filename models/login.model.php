<?php

    # ========= Funções disponíveis ================= #
    # Login
    # Logoff
    # Verificar Token
    # =============================================== #

    require('config/db.php');

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

    function verificar_admin($email, $senha) : bool{
        if ($email == "admin@gmail.com" && $senha == "admin") {
            return true;
        }
        return false;
    }

    function verificar_token(string $token) : bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
    
        try {
            $statement = $banco_de_dados->prepare("SELECT id_usuario FROM sessions WHERE token_sessao = ?");
            $statement->bind_param("s", $token);
            $statement->execute();
            $resultado = $statement->get_result();
    
            return ($resultado && $resultado->num_rows > 0);
        } catch (Exception $erro) {
            throw new Exception("Não foi possível verificar o token de acesso, falha na verificação.");
        }
    }

    function login($email, $senha, $token): string {
        if (verificar_admin($email, $senha)) {
            return "admin";
        }
    
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("SELECT id FROM usuario WHERE email = ? AND senha = ?");
        $statement->bind_param("ss", $email, $senha);
        $statement->execute();
        $resultado = $statement->get_result();
    
        if ($resultado && $resultado->num_rows > 0) {
            $row   = $resultado->fetch_assoc();
            $id    = $row['id'];
            inserir_token($banco_de_dados, $id, $token);

            $_SESSION['logado'] = true;
            return "user";
        }
    
        throw new Exception("Usuário ou senhas incorretos, falha no login");
    }

    function get_usuario_por_token($token) : Usuario {
        require('classes/usuario.class.model.php');

        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $resultado = null;
        try {
            $statement = $banco_de_dados->prepare("SELECT id_usuario FROM sessions WHERE token_sessao = ?");
            $statement->bind_param("s", $token);
            $statement->execute();
            $resultado = $statement->get_result();
            
        } catch (Exception $erro) {
            throw new Exception("Não foi possível verificar o token de acesso, falha na verificação.");
        }

        if ($resultado && $resultado->num_rows > 0){
            $row   = $resultado->fetch_assoc();
            $id_usuario    = $row['id_usuario'];
            
            $statement = $banco_de_dados->prepare("SELECT nome, email FROM usuario WHERE id = ?");
            $statement->bind_param("i", $id_usuario);
            $statement->execute();
            $resultado = $statement->get_result();
            $row = $resultado->fetch_assoc();

            if ($resultado && $resultado->num_rows > 0) {
                return new Usuario($id_usuario, $row['nome'], $row['email']);
            }

            throw new Exception("Esse usuário existe?");
        }

        throw new Exception("Esse token não está registrado");
    }

?>