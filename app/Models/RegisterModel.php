<?php

/*
==================================================================
Funções disponíveis
    cadastrarUsuario       - Cadastra um novo usuário no sistema.
    excluirUsuarioPorEmail - Exclui um usuário do sistema pelo seu email.
==================================================================
*/

class RegisterModel {
    private static $database; // Armazena o objeto de conexão PDO

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    public function registerUser(string $username, string $email, string $passwd) : int {
        $query = self::$database->prepare("INSERT INTO usuario (nome, email, senha) VALUES (:username, :email, :passwd)");

        $query->bindParam(":username", $username, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":passwd", $passwd, PDO::PARAM_STR);

        $query->execute();
        $lastId = self::$database->lastInsertId();
        $query->closeCursor();

        if (!$lastId) {
            throw new Exception("Falha ao cadastrar usuário: não foi possível obter o ID gerado.");
        }
        
        return $lastId;
    }

    public function deleteUserByEmail(string $email): bool {

        $query = self::$database->prepare("DELETE FROM usuario WHERE email = :email");
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->execute();
        
        $result = $query->rowCount();
        $query->closeCursor();

        return $result > 0;
    }
}

?>