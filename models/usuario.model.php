<?php

    require('config/db.php');

    # ========= Funções disponíveis ================= #
    # Cadastrar usuarios
    # Excluir usuarios
    # =============================================== #
    
    function cadastrar_usuario(string $nome, string $email, string $senha): int {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);
        $statement->bind_param("sss", $nome, $email, $hashed_senha);
        $statement->execute();
        
        return $statement->insert_id;
    }

    function excluir_usuario_por_email(string $email): int {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("DELETE FROM usuario WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        
        return $statement->affected_rows;
    }

    function get_usuario_por_id($id_usuario){
        

    }
?>

   