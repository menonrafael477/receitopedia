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

    function inserir_token($banco_de_dados, $id_usuario, $token, $is_admin) {
        try {
            $statement = $banco_de_dados->prepare(
                "INSERT INTO sessions (id_usuario, token_sessao, admin) VALUES (?, ?, ?)"
            );
            $statement->bind_param("isi", $id_usuario, $token, $is_admin);
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

    function is_admin_por_token($token) : bool{
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
    
        try {
            $statement = $banco_de_dados->prepare("SELECT admin FROM sessions WHERE token_sessao = ?");
            $statement->bind_param("s", $token);
            $statement->execute();
            $resultado = $statement->get_result();
    
            if ($resultado && $resultado->num_rows > 0){
                $row   = $resultado->fetch_assoc();
                $is_admin  = $row['admin'];

                return $is_admin;
            }

        } catch (Exception $erro) {
            throw new Exception("Não foi possível verificar o token de acesso, falha na verificação.");
        }

        return false;
    }

    function login($email, $senha, $token): bool {
        $is_admin = false;
        $is_admin = verificar_admin($email, $senha);
    
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("SELECT nome, id FROM usuario WHERE email = ? AND senha = ?");
        $statement->bind_param("ss", $email, $senha);
        $statement->execute();
        $resultado = $statement->get_result();
    
        if ($resultado && $resultado->num_rows > 0) {
            $row   = $resultado->fetch_assoc();
            $nome  = $row['nome'];
            $id    = $row['id'];
            inserir_token($banco_de_dados, $id, $token, $is_admin);

            $_SESSION['logado'] = true;
            $_SESSION['nome_usuario'] = $nome;

            if($is_admin == true && $id == 2) {
                header('Location: admin-panel.php');
            } else {
                header('Location: index.php');
            }

            return true;
        }
    
        throw new Exception("Usuário ou senhas incorretos, falha no login");
    }

    function get_usuario_por_id($id_usuario){
        $banco_de_dados = BancoDeDados::get_banco_de_dados();

        $statement = $banco_de_dados->prepare("SELECT nome, email FROM usuario WHERE id = ?");
        $statement->bind_param("i", $id_usuario);
        $statement->execute();

        return $statement->get_result();
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
            
            $resultado = get_usuario_por_id($id_usuario);
            $row = $resultado->fetch_assoc();

            if ($resultado && $resultado->num_rows > 0) {
                return new Usuario($id_usuario, $row['nome'], $row['email']);
            }

            throw new Exception("Esse usuário existe?");
        }

        throw new Exception("Esse token não está registrado");
    }

?>