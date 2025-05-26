<?php

/*
==================================================================
Funções disponíveis
    CreateRecipe     - Cria uma receita
    UpdateRecipe     - Atualiza uma receita
    GetRecipe        - Pega uma receita por id
    GetAllRecipes    - Pega todas as receitas
    DeleteRecipe     - Apaga uma receita
    SearchByName     - Pesquisa por nome diversas receitas
    SearchByCategory - Pesquisa por categoria diversas receitas
    
==================================================================
*/

class ReceitaModel {
    private static $database;

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    public function createRecipe(string $title, string $content_text, string $photo, string $category) : bool {
        $query = self::$database->prepare("INSERT INTO receita (titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes) VALUES (:title, :content_text, :photo, :category, 0, 0)");
        
        $query->bindParam(":title", $title, PDO::PARAM_STR);
        $query->bindParam(":content_text", $content_text, PDO::PARAM_STR);
        $query->bindParam(":photo", $photo, PDO::PARAM_STR);
        $query->bindParam(":category", $category, PDO::PARAM_STR);
        
        $query->execute();
        $result = $query->rowCount() > 0;
        $query->closeCursor();

        return $result;
    }

    public function updateRecipe(int $id_post, ?string $title, ?string $content_text, ?string $photo, ?string $category) : bool {
        $fields = [];
        $params = [];

        if ($title !== null) {
            $fields[] = "titulo_receita = :title";
            $params[':title'] = $title;
        }

        if ($content_text !== null) {
            $fields[] = "texto_receita = :content_text";
            $params[':content_text'] = $content_text;
        }

        if ($photo !== null) {
            $fields[] = "foto_receita = :photo";
            $params[':photo'] = $photo;
        }

        if ($category !== null) {
            $fields[] = "categoria = :category";
            $params[':category'] = $category;
        }

        if (empty($fields)) {
            return false;
        }

        $query_string = "UPDATE receita SET " . implode(', ', $fields) . " WHERE id = :postId";
        $params[':postId'] = $id_post;
        $query = self::$database->prepare($query_string);
        $query->execute($params);
        
        $result = $query->rowCount() > 0;
        $query->closeCursor();

        return $result;
    }

    public function getRecipe($id_post) : Receita{

        $query = self::$database->prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE id = :id_post");
        $query->bindParam(":id_post", $id_post);
        $query->execute();

        $result = $query->fetchObject();

        if($result == null){
            $query->closeCursor();
            throw new Exception("Não foi possível encontrar nenhuma receita com esse id.");
        }

        $query->closeCursor();
        return new Receita($result->id,$result->titulo_receita,$result->texto_receita,$result->foto_receita,$result->categoria,$result->likes,$result->dislikes);
    }

    public function getAllRecipes() : array {
        $query = self::$database->prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita");
        $query->execute();
        
        $recipes = [];
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach ($rows as $row) {
            $recipes[] = new Receita(
                $row['id'], // Usando 'id'
                $row['titulo_receita'],
                $row['texto_receita'],
                $row['foto_receita'],
                $row['categoria'],
                $row['likes'],
                $row['dislikes']
            );
        }

        $query->closeCursor();
        return $recipes;
    }

    public function deleteRecipe(int $id) : bool {
        $query = self::$database->prepare("DELETE FROM receita WHERE id = :postId");
        $query->bindParam(":postId", $id, PDO::PARAM_INT);
        $query->execute();
        
        $result = $query->rowCount() > 0;
        $query->closeCursor();

        return $result;
    }

        public function searchByName(string $name_part) : array {
        $search_term = $name_part . "%";
        $query = self::$database->prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE titulo_receita LIKE :search_term");
        $query->bindParam(":search_term", $search_term, PDO::PARAM_STR);
        $query->execute();

        $recipes = [];
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach ($rows as $row) {
            $recipes[] = new Receita(
                $row['id'], // Usando 'id'
                $row['titulo_receita'],
                $row['texto_receita'],
                $row['foto_receita'],
                $row['categoria'],
                $row['likes'],
                $row['dislikes']
            );
        }
        $query->closeCursor();
        return $recipes;
    }

    public function searchByCategory(string $category) : array {
        $query = self::$database->prepare("SELECT id, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE categoria = :category");
        $query->bindParam(":category", $category, PDO::PARAM_STR);
        $query->execute();

        $recipes = [];

        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach ($rows as $row) {
            $recipes[] = new Receita(
                $row['id'],
                $row['titulo_receita'],
                $row['texto_receita'],
                $row['foto_receita'],
                $row['categoria'],
                $row['likes'],
                $row['dislikes']
            );
        }

        $query->closeCursor();
        return $recipes;
    }
}

?>

