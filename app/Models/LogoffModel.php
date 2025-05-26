<?php

class LogoffModel {

    private static $database;

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    private function removerToken(int $id_usuario): void {
        try {
            $statement = self::$database->prepare("DELETE FROM sessions WHERE id_usuario = :id_usuario");
            
            $statement->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            
            $statement->execute();
            $statement->closeCursor();

        } catch (PDOException $erro) {
            throw new Exception("Não foi possível remover o token do banco de dados, falha no logoff.");
        }
    }

    public function logoff(int $id_usuario) : bool {
        $this->removerToken($id_usuario);
        return true;
    }

}

?>