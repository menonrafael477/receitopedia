<?php

    require("classes/receita.class.model.php");

    function get_receita(int $id_post): Receita {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("SELECT id_post, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE id_post = ?");
        $statement->bind_param("i", $id_post);
        $statement->execute();
        $resultado = $statement->get_result();
        if ($row = $resultado->fetch_assoc()) {
            return new Receita($row['id_post'], $row['titulo_receita'], $row['texto_receita'], $row['foto_receita'], $row['categoria'], $row['likes'], $row['dislikes']);
        }
        throw new Exception("Não foi possível encontrar nenhuma receita com esse id.");
    }
    
    function criar_receita(string $titulo_receita, string $texto_receita, string $foto_receita, string $categoria): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("INSERT INTO receita (titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes) VALUES (?, ?, ?, ?, 0, 0)");
        $statement->bind_param("ssss", $titulo_receita, $texto_receita, $foto_receita, $categoria);
        $statement->execute();

        return $statement->affected_rows > 0;
    }

    function atualizar_receita(int $id_post, string $titulo, string $categoria, string $texto): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("UPDATE receita SET titulo_receita = ?, texto_receita = ?, categoria = ? WHERE id_post = ?");
        $statement -> bind_param("sssi", $titulo, $texto, $categoria, $id_post);
        $statement -> execute();

        return $statement -> affected_rows > 0;
    }

    function excluir_receita(int $id_post): bool {
        $banco_de_dados = BancoDeDados::get_banco_de_dados();
        $statement = $banco_de_dados->prepare("DELETE FROM receita WHERE id_post = ?");
        $statement->bind_param("i", $id_post);
        $statement->execute();
        
        return $statement->affected_rows > 0;
    }

?>
