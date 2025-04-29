<?php

require('models/receitopedia.model.php');
//require('views/receitopedia.view.php');

class ReceitopediaController {
    
    public function get_todas_receitas_admin() : array {
        //if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $array_receitas = pegar_todas_receitas();
                $indice = 0;
                $posicao = 0;
                $dados = [];
    
                for($indice; $indice < sizeof($array_receitas); $indice++) {
                    $dados = [$posicao => [0 => $array_receitas[$indice]->getId(), 1 => $array_receitas[$indice]->getTituloReceita(), 2 => $indice]];
                    $posicao++;
                }

                return $dados;
            } catch (Exception $erro) {
                return ['status' => 'error', 'message' => $erro->getMessage()];
            }
        //}        
    } 
    public function get_todas_receitas_admin_nome() : array {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }

    public function get_todas_receitas_admin_categoria() : array {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }

    public function get_todas_receitas() : array {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $array_receitas = pegar_todas_receitas();

            } catch (Exception $erro) {
                return(['status' => 'error', 'message' => $erro->getMessage()]);
            }
            }
        }

    public function get_todas_receitas_nome() : array {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }

    public function get_todas_receitas_categoria() : array {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        }
    }
}


$receitopedia_controller = new ReceitopediaController();

if(isset($_GET['action_receitopedia'])) {
    $action = $_GET['action_receitopedia'];
    
    echo json_encode("usuario realizou acao na aba receita");
    
    switch ($action) {
        case 'get_todas_receitas_admin':
            $result = $receitopedia_controller->get_todas_receitas_admin();
            break;

        case 'get_todas_receitas_admin_nome':
            $result = $receitopedia_controller->get_todas_receitas_admin_nome();
            break;

        case 'get_todas_receitas_admin_categoria':
            $result = $receitopedia_controller->get_todas_receitas_admin_categoria();
            break;

        case 'get_todas_receitas':
            $result = $receitopedia_controller->get_todas_receitas();
            break;

        case 'get_todas_receitas_nome':
            $result = $receitopedia_controller->get_todas_receitas_nome();
            break;

        case 'get_todas_receitas_categoria':
            $result = $receitopedia_controller->get_todas_receitas_categoria();
            break;
        default:
            $result = ['status' => 'error', 'message' => "Falha catastrofica: '$action'"];
            break;
    }

    } else {
    return (['status' => 'error', 'message' => 'Acao nao definida']);
}

?>