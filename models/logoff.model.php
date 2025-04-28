<?php

//require('config/db.php');

function remover_token($banco_de_dados, $id_usuario) {
    try {
        $statement = $banco_de_dados->prepare("DELETE FROM sessions WHERE id_usuario = ?");
        $statement->bind_param("i", $id_usuario);
        $statement->execute();
    } catch (Exception $erro) {
        throw new Exception("Não foi possível remover o token do banco de dados, falha no logoff.");
    }
}

function logoff($id_usuario) : int {
    $banco_de_dados = BancoDeDados::get_banco_de_dados();
    remover_token($banco_de_dados, $id_usuario);
    return 1;
}
