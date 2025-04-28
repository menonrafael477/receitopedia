<?php
session_start(); // Certifique-se de iniciar a sessão se ainda não estiver iniciada

require 'config/db.php';

//get_receita, etc.
require 'models/receita.model.php';

// buscar_comentarios_por_receita
require 'models/comentario.model.php';

$id_post = $_GET['id'] ?? null;

if ($id_post) {
    try {
        $receita = get_receita((int)$id_post);
        $comentarios = buscar_comentarios_por_receita((int)$id_post);

        // Inclua a view
        include 'views/receita.view.php';
        exit();

    } catch (Exception $e) {
        // Tratar erro ao obter a receita
        echo "Erro ao carregar a receita: " . $e->getMessage();
        // Você pode redirecionar para uma página de erro aqui
        exit();
    }
} else {
    // Tratar caso o ID da receita não seja fornecido
    echo "ID da receita não especificado.";
    exit();
}
?>