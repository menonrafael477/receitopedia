<?php

class HomeController {
    use PageLoader;

    private $controller;

    public function __construct() {
        $this->controller = new ReceitaController();
    }

    public function loadPageDefault() {
        $this->loadHeader();
        $this->loadBody();
        $this->loadFooter();
    }

    public function loadPageByName($name) {
        $this->loadHeader();
        $this->loadBodyByName($name);
        $this->loadFooter();
    }

    public function loadPageByCategory($category) {
        $this->loadHeader();
        $this->loadBodyByCategory($category);
        $this->loadFooter();
    }

    public function loadSearchButton(){
        $name = $_POST['search_text'] ?? null;
        $this->loadPageByName($name);
    }

    private function loadBody() {
        try {
            $receitas = $this->controller->getAllRecipes();
            require_once HOME_VIEW;
        } catch (Exception $e) {
            http_response_code(404);
            echo "<h1>Erro 404: Receita não encontrada!</h1>".$e->getMessage();

        }
    }

    private function loadBodyByName($name){
        try {
            $receitas = $this->controller->getRecipesByName($name);
            require_once HOME_VIEW;
        } catch (Exception $e) {
            http_response_code(404);
            echo "<h1>Erro 404: Receita não encontrada!</h1>".$e->getMessage();

        }
    }

    private function loadBodyByCategory($category) {
        try {
            $receitas = $this->controller->getRecipesByCategory($category);
            require_once HOME_VIEW;
        } catch (Exception $e) {
            http_response_code(404);
            echo "<h1>Erro 404: Receita não encontrada!</h1>".$e->getMessage();

        }
    }

}

?>