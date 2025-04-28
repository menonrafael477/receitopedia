<?php

require('models/like.model.php');

class LikeController {

    public function darLike() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_receita = $_POST['id_receita'] ?? null;
            $id_usuario = $_SESSION['id_usuario'] ?? null; // Assumindo que o ID do usuário está na sessão

            if ($id_receita && $id_usuario) {
                try {
                    LikeModel::registrarAvaliacao($id_receita, $id_usuario, 1); // 1 representa like
                    echo json_encode(['status' => 'success', 'message' => 'Like registrado com sucesso.']);
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID da receita ou ID do usuário não informado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function darDislike() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_receita = $_POST['id_receita'] ?? null;
            $id_usuario = $_SESSION['id_usuario'] ?? null; // Assumindo que o ID do usuário está na sessão

            if ($id_receita && $id_usuario) {
                try {
                    LikeModel::registrarAvaliacao($id_receita, $id_usuario, -1); // -1 representa dislike
                    echo json_encode(['status' => 'success', 'message' => 'Dislike registrado com sucesso.']);
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID da receita ou ID do usuário não informado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function removerAvaliacao() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_receita = $_POST['id_receita'] ?? null;
            $id_usuario = $_SESSION['id_usuario'] ?? null; // Assumindo que o ID do usuário está na sessão

            if ($id_receita && $id_usuario) {
                try {
                    $removido = LikeModel::removerAvaliacaoUsuario($id_receita, $id_usuario);
                    if ($removido) {
                        echo json_encode(['status' => 'success', 'message' => 'Avaliação removida com sucesso.']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Nenhuma avaliação encontrada para remover.']);
                    }
                } catch (Exception $e) {
                    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID da receita ou ID do usuário não informado.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function obterContagemLikes($id_receita) {
        return LikeModel::getContagemAvaliacoes($id_receita, 1);
    }

    public function obterContagemDislikes($id_receita) {
        return LikeModel::getContagemAvaliacoes($id_receita, -1);
    }

    public function verificarAvaliacaoUsuario($id_receita, $id_usuario) {
        return LikeModel::getAvaliacaoUsuario($id_receita, $id_usuario);
    }
}

$controller = new LikeController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'dar_like':
            $controller->darLike();
            break;
        case 'dar_dislike':
            $controller->darDislike();
            break;
        case 'remover_avaliacao':
            $controller->removerAvaliacao();
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida para likes/dislikes.']);
            break;
    }
}

?>