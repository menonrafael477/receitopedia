<?php
require('models/receitopedia.model.php');
require('views/receitopedia.view.php');

class ReceitopediaController {

    public function exibirReceitas() {
        $receitas = pegar_todas_receitas();

        $view = new ReceitopediaView();
        $view->renderizar($receitas);
    }
}

$controller = new ReceitopediaController();
$controller->exibirReceitas();
?>