<?php

    # ========= Funções disponíveis ================= #
    # Verificar Id Usuario Comentario 
    #   -Descrição: Verifica se o ID do usuário é o mesmo do comentário, para fins de verificar a permissão!
    # Criar Comentario
    # Editar Comentario
    # Apagar Comentario
    # =============================================== #

    function verificar_id_usuario_comentario(int $id_usuario, int $id_comentario): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("SELECT id FROM comentarios WHERE id = ? AND id_usuario = ?");
        $statement->bind_param("ii", $id_comentario, $id_usuario);
        $statement->execute();
        $resultado = $statement->get_result();
        return ($resultado && $resultado->num_rows > 0);
    }
    
    function criar_comentario(int $id_usuario, int $id_post, string $texto): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("INSERT INTO comentarios (id_receita, id_usuario, texto_comentario) VALUES (?, ?, ?)");
        $statement->bind_param("iis", $id_post, $id_usuario, $texto);
        $statement->execute();
    
        return $statement->affected_rows > 0;
    }
    
    function editar_comentario(int $id_comentario, string $texto): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("UPDATE comentarios SET texto_comentario = ? WHERE id = ?");
        $statement->bind_param("si", $texto, $id_comentario);
        $statement->execute();
    
        return $statement->affected_rows > 0;
    }
    
    function apagar_comentario(int $id_comentario): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("DELETE FROM comentarios WHERE id = ?");
        $statement->bind_param("i", $id_comentario);
        $statement->execute();
    
        return $statement->affected_rows > 0;
    }

?>