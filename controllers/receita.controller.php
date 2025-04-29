<?php

//require('views/receita.view.php');
require("views/admin-panel-view.php"); 

class ReceitaController {

    public function criar_receita(){
        require('models/receita.model.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo_receita = $_POST['titulo_receita'] ?? null;
            $texto_receita = $_POST['texto_receita'] ?? null;
            $foto_receita = $_POST['foto_receita'] ?? "none";
            $categoria = $_POST['categoria'] ?? null;

            criar_receita($titulo_receita, $texto_receita, $foto_receita, $categoria);

           
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }

    public function get_receita() {
        require('models/receita.model.php');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_post = $_POST['id_post'] ?? null;

            if ($id_post) {
                return get_receita($id_post);
            } else {
                return(['status' => 'error', 'message' => 'ID da receita não fornecido.']);
            }
        } else {
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
        }
    }
}

$receita_controller = new ReceitaController();

if(isset($_GET['action_receita'])) {
    $action = $_GET['action_receita'];
    
    echo json_encode("usuario realizou acao na aba receita");
    
    switch ($action) {

        case 'criar':
            $receita_controller->criar_receita();
            break;

        case 'editar':
            $receita_controller->get_receita();
            break;

        default:
            echo json_encode(['status' => 'error', 'message' => "Falha catastrofica: '$action'"]);
    }

    } else {
    return (['status' => 'error', 'message' => 'Acao nao definida']);
}

?>
