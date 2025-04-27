<?php

require('models/receita.model.php');

class ReceitaController {

    public function getReceita() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $id_post = $_GET['id_post'] ?? null;

            if ($id_post === null) {
                return (['status' => 'error', 'message' => 'ID da receita não informado.']);
            }

            try {
                $receita = get_receita((int)$id_post);

                return json_encode ([
                    'status' => 'success',
                    'data' => [
                        'id_post' => $receita->getId(),
                        'titulo_receita' => $receita->getTituloReceita(),
                        'texto_receita' => $receita->getTextoReceita(),
                        'foto_receita' => $receita->getFotoReceita(),
                        'categoria' => $receita->getCategoria(),
                        'likes' => $receita->getLikes(),
                        'dislikes' => $receita->getDislikes()
                    ]
                ]);

            } catch (Exception $e) {
                return (['status' => 'error', 'message' => $e->getMessage()]);
            }
        } else {
            return (['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function criarReceita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;

            $titulo = $dados['titulo_receita'] ?? '';
            $texto = $dados['texto_receita'] ?? '';
            $foto = $dados['foto_receita'] ?? '';
            $categoria = $dados['categoria'] ?? '';

            if (empty($titulo) || empty($texto) || empty($categoria)) {
                return (['status' => 'error', 'message' => 'Campos obrigatórios não informados.']);
            }

            try {
                $sucesso = criar_receita($titulo, $texto, $foto, $categoria);

                if ($sucesso) {
                    return (['status' => 'success', 'message' => 'Receita criada com sucesso.']);
                } else {
                    return (['status' => 'error', 'message' => 'Falha ao criar a receita.']);
                }

            } catch (Exception $e) {
                return (['status' => 'error', 'message' => $e->getMessage()]);
            }

        } else {
            return (['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function atualizarReceita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;

            $id_post = $dados['id_post'] ?? null;
            $titulo = $dados['titulo_receita'] ?? '';
            $texto = $dados['texto_receita'] ?? '';
            $categoria = $dados['categoria'] ?? '';

            if (!$id_post || empty($titulo) || empty($texto) || empty($categoria)) {
                return (['status' => 'error', 'message' => 'Campos obrigatórios não informados.']);
            }

            try {
                $sucesso = atualizar_receita((int)$id_post, $titulo, $categoria, $texto);

                if ($sucesso) {
                    return (['status' => 'success', 'message' => 'Receita atualizada com sucesso.']);
                } else {
                    return (['status' => 'error', 'message' => 'Falha ao atualizar a receita.']);
                }

            } catch (Exception $e) {
                return (['status' => 'error', 'message' => $e->getMessage()]);
            }

        } else {
            return (['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function excluirReceita() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_post = $_POST['id_post'] ?? null;

            if ($id_post === null) {
                return (['status' => 'error', 'message' => 'ID da receita não informado.']);
            }

            try {
                $sucesso = excluir_receita((int)$id_post);

                if ($sucesso) {
                    return (['status' => 'success', 'message' => 'Receita excluída com sucesso.']);
                } else {
                    return (['status' => 'error', 'message' => 'Falha ao excluir a receita.']);
                }

            } catch (Exception $e) {
                return (['status' => 'error', 'message' => $e->getMessage()]);
            }

        } else {
            return (['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }
}

$controller = new ReceitaController();

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'get':
            echo $controller->getReceita();
            break;
        case 'create':
            echo json_encode($controller->criarReceita());
            break;
        case 'update':
            echo json_encode($controller->atualizarReceita());
            break;
        case 'delete':
            echo json_encode($controller->excluirReceita());
            break;
        default:
            echo json_encode(['status' => 'error', 'message' => 'Ação inválida.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Ação não especificada.']);
}
?>
