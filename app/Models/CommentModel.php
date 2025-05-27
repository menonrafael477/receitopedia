<?php

/*
==================================================================
Funções disponíveis
    verificarIdUsuarioComentario  - Verifica se o ID do usuário é o mesmo do comentário, para fins de verificar a permissão.
    criarComentario               - Cria um novo comentário para uma receita.
    editarComentario              - Edita o texto de um comentário existente.
    apagarComentario              - Apaga um comentário do sistema.
    buscarComentariosPorReceita   - Busca todos os comentários associados a uma receita específica.
==================================================================
*/

class CommentModel {
    private static $database;

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    public function verificarIdUsuarioComentario(int $id_usuario, int $id_comentario): bool {
        $query = self::$database->prepare("SELECT id FROM comentarios WHERE id = :id_comentario AND id_usuario = :id_usuario");
        
        $query->bindParam(":id_comentario", $id_comentario, PDO::PARAM_INT);
        $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return ($result !== false);
    }
    
    public function criarComentario(int $id_receita, int $id_usuario, string $texto): bool {
        $query = self::$database->prepare("INSERT INTO comentarios (id_receita, id_usuario, texto_comentario) VALUES (:id_receita, :id_usuario, :texto)");
        
        $query->bindParam(":id_receita", $id_receita, PDO::PARAM_INT);
        $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $query->bindParam(":texto", $texto, PDO::PARAM_STR);
        
        $query->execute();
        $affectedRows = $query->rowCount();
        $query->closeCursor();

        return $affectedRows > 0;
    }
    
    public function editarComentario(int $id_comentario, string $texto): bool {
        $query = self::$database->prepare("UPDATE comentarios SET texto_comentario = :texto WHERE id = :id_comentario");
        
        $query->bindParam(":texto", $texto, PDO::PARAM_STR);
        $query->bindParam(":id_comentario", $id_comentario, PDO::PARAM_INT);
        
        $query->execute();
        $affectedRows = $query->rowCount();
        $query->closeCursor();

        return $affectedRows > 0;
    }
    
    public function apagarComentario(int $id_comentario): bool {
        $query = self::$database->prepare("DELETE FROM comentarios WHERE id = :id_comentario");
        
        $query->bindParam(":id_comentario", $id_comentario, PDO::PARAM_INT);
        
        $query->execute();
        $affectedRows = $query->rowCount();
        $query->closeCursor();

        return $affectedRows > 0;
    }

    public function buscarComentariosPorReceita(int $id_receita): array {
        $query = self::$database->prepare("
            SELECT comentarios.id, comentarios.texto_comentario, usuario.nome AS nome_usuario, comentarios.id_usuario
            FROM comentarios
            JOIN usuario ON comentarios.id_usuario = usuario.id
            WHERE comentarios.id_receita = :id_receita
        ");

        $query->bindParam(":id_receita", $id_receita, PDO::PARAM_INT);
        $query->execute();
        
        $comentarios = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        return $comentarios;
    }

}

?>