<?php

    # ========= Funções disponíveis ================= #
    # pesquisar por categoria
    # pesquisar por nome
    # get todas receitas
    # =============================================== #

require("classes/receita.class.model.php");

function criar_array($result) : array {
    $resultados = [];
    while ($row = $result -> fetch_assoc()) {
        $resultados[] = new Receita(
            $row['id'],
            $row['titulo_receita'],
            $row['texto_receita'],
            $row['foto_receita'],
            $row['categoria'],
            $row['likes'],
            $row['dislikes']
        );
    }

    
    return $resultados;
}

function pesquisar_por_categoria($categoria) : array {
    $banco_de_dados = BancoDeDados::get_banco_de_dados();
    $resultados = [];

    $statement = $banco_de_dados -> prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE categoria = ?");
    $statement -> bind_param("s", $categoria);
    $statement -> execute();
    $result = $statement -> get_result();

    try{
        return criar_array($result);
    } finally {
        $statement->close();
    }
}

function pesquisar_por_nome($nome) : array {
    $banco_de_dados = BancoDeDados::get_banco_de_dados();
    $resultados = [];
    $termo_pesquisa = "%" . $nome . "%";

    $statement = $banco_de_dados -> prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE titulo_receita LIKE ?");
    $statement -> bind_param("s", $termo_pesquisa);
    $statement -> execute();
    $result = $statement -> get_result();

    try{
        return criar_array($result);
    } finally {
        $statement->close();
    }
}

function get_todas_receitas() : array{
    $banco_de_dados = BancoDeDados::get_banco_de_dados();
    $resultados = [];

    $statement = $banco_de_dados -> prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita");
    $statement -> execute();
    $result = $statement -> get_result();

    try{
        return criar_array($result);
    } finally {
        $statement->close();
    }
}

?>