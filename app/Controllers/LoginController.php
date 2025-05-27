<?php

class LoginController {
    use PageLoader;
    private $loginModel;  


    public function __construct() {
        $this->loginModel = new LoginModel();
    }

    private function loadBody() {
        require_once LOGIN_VIEW;
    }

    public function loadPageContent() {
        $this->loadHeader();
        $this->loadBody();
        $this->loadFooter();
    }

    private function verificarString($string) : void{
        if ($string == null){
            throw new Exception("String não pode ser null");
        }
    }

    public function login() : bool {
        try {
            $email = $_POST['email'] ?? null;
            $passwd = $_POST['passwd'] ?? null;

            $token_sessao = $_COOKIE['PHPSESSID'];

            $this->verificarString($email);
            $this->verificarString($passwd);
            
            $resultado = $this->loginModel->login($email,$passwd,$token_sessao);

            header('Location: /');
            return $resultado;
        } catch (Exception $e) {
            echo "SESSAO: ". $token_sessao . "<br>";
            echo "Erro ao relizar login: " . $e->getMessage();
        }

        return false;
    }

    public function loginBySession() : bool{
        try {
            $token_sessao = $_COOKIE['PHPSESSID'];
            $resultado = $this->loginModel->verificarToken($token_sessao);

            return $resultado;
        } catch (Exception $e) {
            echo "Erro ao relizar login por token: " . $e->getMessage();
        }

        return false;
    }

    public function getUserBySession() : Usuario | null {
        try {
            $token_sessao = $_COOKIE['PHPSESSID'];
            $usuario = $this->loginModel->getUsuarioPorToken($token_sessao);

            return $usuario;
        } catch (Exception $e) {
            //echo "Erro ao relizar login por token: " . $e->getMessage();
        }

        return null;
    }

    public function isAdminByToken() : bool {
        $result = null;

        try {
            $token_sessao = $_COOKIE['PHPSESSID'];
            $result = $this->loginModel->isAdminPorToken($token_sessao);
 
        } catch (Exception $e) {
            echo "Erro ao verificar administrador, redirecionando... erro: " . $e->getMessage();
            header('Location: /');
        }
        
        if ($result != true){
            header('Location: /');
        }

        return $result;
    }

    public function logout() : bool {
        try {
            $token_sessao = $_COOKIE['PHPSESSID'];

            $usuario = $this->loginModel->getUsuarioPorToken($token_sessao);
            $this->loginModel->logoff($usuario->get_id());

            header('Location: /');
            return true;
        } catch (Exception $e) {
            echo "Erro ao relizar login por token: " . $e->getMessage();
        }

        return false;
    }

}