<?php

    # ========= Funções disponíveis ================= #
    # Cadastrar usuarios
    # Excluir usuarios
    # =============================================== #
    
    require('config/db.php');
    function cadastrar_usuario(string $nome, string $email, string $senha): int {
        if ($nome == null || $email == null || $senha == null){
            throw new Exception("Dados de entrada inválidos");
        }

        $banco_de_dados = BancoDeDados::get_banco_de_dados();

        $statement = $banco_de_dados->prepare("INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)");
        $statement->bind_param("sss", $nome, $email, $senha);
        $statement->execute();
        
        return $statement -> insert_id;
    }

    function excluir_usuario_por_email(string $email): int {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("DELETE FROM usuario WHERE email = ?");
        $statement->bind_param("s", $email);
        $statement->execute();
        
        return $statement->affected_rows;
    }
    
?>

   