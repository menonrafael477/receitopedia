<?php

    # ========= Funções disponíveis ================= #
    # dar_like
    # dar_dislike
    # remover_avaliacao
    # get_avaliacao
    #   Descrição: recupera a avaliação de um usuário em determinado post (útil na hora de carregar a página)
    # =============================================== #

    function get_avaliacao($id_usuario, $id_post) : int {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
    
        $statement = $banco_de_dados->prepare("SELECT like_valor FROM usuario_like WHERE id_usuario = ? AND id_receita = ?");
        $statement->bind_param("ii", $id_usuario, $id_post);
        $statement->execute();
        $resultado = $statement->get_result();
        
        $valor_atual = 0;
        if ($row = $resultado->fetch_assoc()) {
            $valor_atual = $row['like_valor'];
        }
    
        return $valor_atual;
    }

    function atualizar_avaliacao(int $id_usuario, int $id_post, int $novo_valor): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
    
        $antigo_valor = get_avaliacao($id_usuario, $id_post);
    
        if ($antigo_valor !== $novo_valor) {
            if ($novo_valor === 0) {
                $statement = $banco_de_dados->prepare("DELETE FROM usuario_like WHERE id_usuario = ? AND id_receita = ?");
                $statement->bind_param("ii", $id_usuario, $id_post);
            } elseif ($antigo_valor === 0) {
                $statement = $banco_de_dados->prepare("INSERT INTO usuario_like (id_receita, id_usuario, like_valor) VALUES (?, ?, ?)");
                $statement->bind_param("iii", $id_post, $id_usuario, $novo_valor);
            } else {
                $statement = $banco_de_dados->prepare("UPDATE usuario_like SET like_valor = ? WHERE id_usuario = ? AND id_receita = ?");
                $statement->bind_param("iii", $novo_valor, $id_usuario, $id_post);
            }
            $statement->execute();
    
            $dl = 0;
            $dd = 0;
            if ($novo_valor === 1)    $dl++;
            if ($novo_valor === -1)   $dd++;
            if ($antigo_valor === 1)  $dl--;
            if ($antigo_valor === -1) $dd--;
    
            $statement = $banco_de_dados->prepare("UPDATE receita SET likes = likes + ?, dislikes = dislikes + ? WHERE id = ?");
            $statement->bind_param("iii", $dl, $dd, $id_post);
            $statement->execute();
        }
    
        return true;
    }
    
    function dar_like(int $id_usuario, int $id_post): bool {
        return atualizar_avaliacao($id_usuario, $id_post, 1);
    }
    
    function dar_dislike(int $id_usuario, int $id_post): bool {
        return atualizar_avaliacao($id_usuario, $id_post, -1);
    }
    
    function remover_avaliacao(int $id_usuario, int $id_post): bool {
        return atualizar_avaliacao($id_usuario, $id_post, 0);
    }

?>

