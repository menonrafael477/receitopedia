<?php
require_once('Database.php');
require_once('classes/Receita.php');

class ReceitaModel {
    private $database;

    public function __construct() {
        self::$database = Database::GetDatabase();
    }

    public function CreateRecipe(string $title, string $content_text, string $photo, string $category) : bool {
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

    public function UpdateRecipe(int $id_post, string $title, string $content_text, string $photo, string $category) : bool {
        $query = self::$database->prepare("UPDATE receita SET titulo_receita = :title, texto_receita = :content_text, foto_receita = :photo, categoria = :category WHERE id_post = :postId");
        
        $query->bindParam(":title", $title, PDO::PARAM_STR);
        $query->bindParam(":content_text", $content_text, PDO::PARAM_STR);
        $query->bindParam(":photo", $photo, PDO::PARAM_STR);
        $query->bindParam(":category", $category, PDO::PARAM_STR);
        $query->bindParam(":postId", $id_post, PDO::PARAM_INT);
        
        $query->execute();
        $result = $query->rowCount() > 0;
        $query->closeCursor();

        return $result;
    }

    public function DeleteRecipe(int $id_post) : bool {
        $query = self::$database->prepare("DELETE FROM receita WHERE id_post = :postId");
        $query->bindParam(":postId", $id_post, PDO::PARAM_INT);
        $query->execute();
        
        $result = $query->rowCount() > 0;
        $query->closeCursor();

        return $result;
    }

    public function SearchByCategory(string $category) : array {
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

    public function SearchByName(string $name_part) : array {
        $search_term = "%" . $name_part . "%";
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

    public function GetRecipe($id_post) : Receita{

        $query = self::$database->prepare("SELECT id_post, titulo_receita, texto_receita, foto_receita, categoria, likes, dislikes FROM receita WHERE id_post = :id_post");
        $query->bindParam(":id_post", $id_post);
        $query->execute();

        $result = $query->fetchObject();

        if($result == null){
            $query->closeCursor();
            throw new Exception("Não foi possível encontrar nenhuma receita com esse id.");
        }

        $query->closeCursor();
        return new Receita($result->id_post,$result->titulo_receita,$result->texto_receita,$result->foto_receita,$result->categoria,$result->likes,$result->dislikes);
    }

    public function GetAllRecipes() : array {
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

}

?>