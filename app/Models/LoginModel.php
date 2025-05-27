<?php

/*
==================================================================
Métodos disponíveis na LoginModel
    gerarToken                  - Gera um token de sessão seguro.
    inserirToken                - Insere um token de sessão no banco de dados.
    verificarAdmin              - Verifica credenciais de administrador (lógica local, insegura).
    verificarToken              - Verifica se um token de sessão é válido.
    isAdminPorToken             - Verifica se um token de sessão pertence a um administrador.
    login                       - Tenta autenticar um usuário e gerenciar a sessão.
    getUsuarioPorId             - Busca dados de um usuário pelo seu ID.
    getUsuarioPorToken          - Busca um objeto Usuario com base em um token de sessão.
==================================================================
*/

class LoginModel {
    private static $database;

    public function __construct() {
        self::$database = Database::getDatabase();
    }

    public function gerarToken() : string{
        return bin2hex(random_bytes(32));
    }

    public function inserirToken(int $id_usuario, string $token, int $isAdmin) {
        try {
            $statement = self::$database->prepare(
                "INSERT INTO sessions (id_usuario, token_sessao, admin) VALUES (:id_usuario, :token_sessao, :isadmin)"
            );
            $statement->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
            $statement->bindParam(":token_sessao", $token, PDO::PARAM_STR);
            $statement->bindParam(":isadmin", $isAdmin, PDO::PARAM_INT);
            $statement->execute();
            $statement->closeCursor();

        } catch (PDOException $erro) {
            throw new Exception("Não foi possível inserir token no banco de dados, falha na operação. Erro: ".$erro->getMessage());
        }
    }

    public function verificarToken(string $token) : bool {
        try {
            $statement = self::$database->prepare("SELECT id_usuario FROM sessions WHERE token_sessao = :token_sessao");
            $statement->bindParam(":token_sessao", $token, PDO::PARAM_STR);
            $statement->execute();
            
            $id_usuario = $statement->fetchColumn();
            $statement->closeCursor();
    
            return ($id_usuario !== false);
        } catch (PDOException $erro) {
            throw new Exception("Não foi possível verificar o token de acesso, falha na verificação.");
        }
    }

    public function isAdminPorToken(string $token) : bool {
        try {
            $statement = self::$database->prepare("SELECT admin FROM sessions WHERE token_sessao = :token_sessao");
            $statement->bindParam(":token_sessao", $token, PDO::PARAM_STR);
            $statement->execute();
            
            $row = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
    
            if ($row){
                return (bool) $row['admin'];
            }
        } catch (PDOException $erro) {
            throw new Exception("Não foi possível verificar o privilégio do token, falha na verificação.");
        }
        return false;
    }

    public function login(string $email, string $senha, string $token): bool {
        $isAdmin = false;
    
        $statement = self::$database->prepare("SELECT nome, id, isAdmin FROM usuario WHERE email = :email AND senha = :senha");
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":senha", $senha, PDO::PARAM_STR);
        $statement->execute();

        $usuario = $statement->fetch(PDO::FETCH_ASSOC);

        $isAdmin = $usuario['isAdmin'];
        $statement->closeCursor();
    
        if ($usuario) {
            $id   = $usuario['id'];
            
            $this->inserirToken($id, $token, (int)$isAdmin);
            return true;
        }
    
        throw new Exception("Usuário ou senhas incorretos, falha no login");
    }

    public function getUsuarioPorId(int $id_usuario) {
        $statement = self::$database->prepare("SELECT nome, email, isAdmin FROM usuario WHERE id = :id_usuario");
        $statement->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $statement->execute();

        $usuario_data = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        return $usuario_data;
    }

    public function getUsuarioPorToken(string $token) : Usuario {

        $id_usuario = null;
        try {
            $statement = self::$database->prepare("SELECT id_usuario FROM sessions WHERE token_sessao = :token_sessao");
            $statement->bindParam(":token_sessao", $token, PDO::PARAM_STR);
            $statement->execute();
            
            $id_usuario_result = $statement->fetchColumn();
            $statement->closeCursor();

            if ($id_usuario_result === false) {
                throw new Exception("Esse token não está registrado ou a sessão é inválida.");
            }
            $id_usuario = (int)$id_usuario_result;
            
        } catch (PDOException $erro) {
            throw new Exception("Não foi possível verificar o token de acesso para buscar usuário.");
        }

        $dados_usuario = $this->getUsuarioPorId($id_usuario);

        if ($dados_usuario) {
            return new Usuario($id_usuario, $dados_usuario['nome'], $dados_usuario['email'], $dados_usuario['isAdmin']);
        }

        throw new Exception("Usuário associado ao token não encontrado (ID: " . $id_usuario . ").");
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