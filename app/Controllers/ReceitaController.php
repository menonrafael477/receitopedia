<?php 

class ReceitaController {
    private $receitaModel;
    use PageLoader;

    public function __construct() {
        $this->receitaModel = new ReceitaModel();
    }

    private function loadBodyRegisterRecipe() {
        $receitas = $this->getAllRecipes();
        $receita_selecionada = null;
        require_once ADMIN_VIEW;
    }

    private function loadBodyRecipe($id) {
        try {
            $receita = $this->getRecipeById($id);
            require_once RECIPE_VIEW;
        } catch (Exception $e) {
            http_response_code(404);
            echo "<h1>Erro 404: Receita não encontrada!</h1>".$e->getMessage();
        }
    }

    public function loadPageContentRecipe($id) {
        $this->loadHeader();
        $this->loadBodyRecipe($id);
        $this->loadFooter();
    }

    public function loadPageContentRegisterRecipe() {
        $this->loadHeader();
        $this->loadBodyRegisterRecipe();
        $this->loadFooter();
    }

    public function loadPageAdminUpdate($id) {
        $this->loadHeader();
        $this->loadUpdatePage($id);
        $this->loadFooter();
    }

    private function loadUpdatePage($id){
        $receita_selecionada = $this->getRecipeById($id);
        require ADMIN_VIEW;
    }

    private function verificarString($string) : void{
        if ($string == null){
            throw new Exception("String não pode ser null");
        }
    }

    public function createRecipe() {   
        try {
            $title = $_POST['title'] ?? null;
            $content_text = $_POST['content_text'] ?? null;
            $category = $_POST['category'] ?? null;

            $photo_base64 = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['photo']['tmp_name'];
                $file_content = file_get_contents($file_tmp_path);
                $photo_base64 = base64_encode($file_content);

            }

            $this->verificarString($title);
            $this->verificarString($content_text);
            $this->verificarString($photo_base64);
            $this->verificarString($category);
            $result = $this->receitaModel->createRecipe($title, $content_text, $photo_base64, $category);
            header('Location: /admin-panel');
            echo "CRIOU RECEITA!";
            return $result;
        } catch (Exception $e) {
            echo "Erro ao criar receita: " . $e->getMessage();
        }
    }

    public function updateRecipe() {
        try {
            $id_post = $_POST['id_post'] ?? null;
            $title = $_POST['title'] ?? null;
            $content_text = $_POST['content_text'] ?? null;
            $category = $_POST['category'] ?? null;

            $photo_base64 = null;

            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $file_tmp_path = $_FILES['photo']['tmp_name'];
                $file_content = file_get_contents($file_tmp_path);
                $photo_base64 = base64_encode($file_content);

            }
            $this->verificarString($id_post);
            
            header('Location: /admin-panel');
            return $this->receitaModel->updateRecipe($id_post, $title, $content_text, $photo_base64, $category);
        } catch (Exception $e) {
            echo "Erro ao atualizar receita: " . $e->getMessage();
        }
    }

    public function getRecipeById($id) : Receita {
        try {
            $receita = $this->receitaModel->getRecipe($id);

            return $receita;
        } catch (Exception $e) {
                echo "Erro ao obter receita: " . $e->getMessage();
        } throw new Exception("Não foi possível obter a receita por id. Erro catastrófico");
    }

    public function getAllRecipes() : array {
        try {
            return $this->receitaModel->getAllRecipes();
        } catch (Exception $e) {
            echo "Erro ao obter receitas: " . $e->getMessage();
        }

        throw new Exception("Não foi possível retornar um array");
    }

    public function getRecipesByName($name) : array {
        try {
            return $this->receitaModel->searchByName($name);
        } catch (Exception $e) {
            echo "Erro ao obter receitas: " . $e->getMessage();
        }

        throw new Exception("Não foi possível retornar um array");
    }

    public function getRecipesByCategory($category) : array {
        try {
            return $this->receitaModel->searchByCategory($category);
        } catch (Exception $e) {
            echo "Erro ao obter receitas: " . $e->getMessage();
        }

        throw new Exception("Não foi possível retornar um array");
    }

    public function deleteRecipe($id) {
        header('Location: /admin-panel');
        return $this->receitaModel->deleteRecipe($id);
    }
}

?>
