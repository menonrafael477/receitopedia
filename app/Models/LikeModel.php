<?php

class LikeModel {
    private static $database;

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    private function getCurrentLikeState($id_usuario, $id_receita) {
        $query = self::$database->prepare("SELECT like_valor FROM usuario_like WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
        $query->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $query->bindParam(":id_receita", $id_receita, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchColumn();
    }

    private function updateLike($id_usuario, $id_receita, $voto){
        self::$database->beginTransaction();

        try{
            // 1 = like
            // 0 = neutro
            // -1 = dislike
            $currentState = $this->getCurrentLikeState($id_usuario, $id_receita) ?: 0;
            $auxiliar = false;

            if ($voto == $currentState){
                $auxiliar = true;
            }

            // Significa que saiu do 1 para o 0
            if ($voto == 1 && $auxiliar == true) {
                // UPDATE usuario_like SET OR UPDATE like_valor = 0 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET like -= 1 WHERE id = $id_receita;

                
                $queryUser = self::$database->prepare("UPDATE usuario_like SET like_valor = 0 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);

            // Significa que saiu do -1 para o 0
            } else if ($voto == -1 && $auxiliar == true) {
                // UPDATE usuario_like SET OR UPDATE like_valor = 0 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET dislike -= 1 WHERE id = $id_receita;

                $queryUser = self::$database->prepare("UPDATE usuario_like SET like_valor = 0 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);
            // Sinifica que saiu do -1 para o 1
            } else if ($voto == 1 && $currentState == -1) {                
                // UPDATE usuario_like SET OR UPDATE like_valor = 1 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET dislike -= 1 WHERE id = $id_receita;
                // UPDATE receita SET like += 1 WHERE id = $id_receita;

                $queryUser = self::$database->prepare("UPDATE usuario_like SET like_valor = 1 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);
            // Sinifica que saiu do 1 para o -1
            } else if ($voto == -1 && $currentState == 1) {
                // UPDATE usuario_like SET OR UPDATE like_valor = -1 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET dislike += 1 WHERE id = $id_receita;
                // UPDATE receita SET like -= 1 WHERE id = $id_receita;
            
                $queryUser = self::$database->prepare("UPDATE usuario_like SET like_valor = -1 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);
            // Significa que saiu do 0 para o 1
            } else if ($voto == 1) {
                // INSERT usuario_like SET OR UPDATE like_valor = 1 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET like += 1 WHERE id = $id_receita;

                $queryUser = self::$database->prepare("INSERT INTO usuario_like like_valor = 1 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);
            // Significa que saiu do 0 para o -1
            } else if ($voto == -1) {
                // INSERT usuario_like SET OR UPDATE like_valor = -1 WHERE id_usuario = $id_usuario;
                // UPDATE receita SET dislike += 1 WHERE id = $id_receita;

                $queryUser = self::$database->prepare("INSERT INTO usuario_like like_valor = -1 WHERE id_usuario = :id_usuario AND id_receita = :id_receita");
                $queryUser->execute([':id_usuario' => $id_usuario, ':id_receita' => $id_receita]);
            }

            self::$database->commit();

            return true;
        }catch(Exception $erro){

            self::$database->rollBack();
        }

        return false;
    }

    public function like($id_usuario, $id_receita) : bool {
        return $this->updateLike($id_usuario, $id_receita,1);
    }

    public function dislike($id_usuario, $id_receita) : bool {
        return $this->updateLike($id_usuario, $id_receita,-1);
    }
}