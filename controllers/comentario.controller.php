<?php
//session_start(); verificar se precis disso ou não

require('models/comentario.controller.php');
require('models/comentario.model.php');
require('models/usuario.model.php');

function criarComentario() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['id_usuario'])) {
        $id_receita = filter_input(INPUT_POST, 'id_receita', FILTER_SANITIZE_NUMBER_INT);
        $texto_comentario = filter_input(INPUT_POST, 'texto_comentario', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $id_usuario = $_SESSION['id_usuario'];

        if ($id_receita && $texto_comentario) {
            if (criar_comentario($id_usuario, $id_receita, $texto_comentario)) {
                // Redirecionar de volta para a página da receita
                header("Location: receita.php?id=" . $id_receita);
                exit();
            } else {
                echo "Erro ao criar o comentário.";
            }
        } else {
            echo "Dados do comentário incompletos.";
        }
    } else {
        echo "Acesso inválido.";
    }
}

function listarComentariosPorReceita(int $id_receita): array {
    return buscar_comentarios_por_receita($id_receita);
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'criar_comentario':
            criarComentario();
            break;
        // Você pode adicionar mais casos aqui para editar e apagar comentários
    }
}

// Para carregar os comentários na página da receita, você precisará chamar
// a função listarComentariosPorReceita no seu controller da página de receita
// e passar os resultados para a view.
?>