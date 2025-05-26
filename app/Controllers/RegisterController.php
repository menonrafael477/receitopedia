<?php

class RegisterController {
    use PageLoader;
    private $registerModel;

    public function __construct() {
        $this->registerModel = new RegisterModel();
    }

    private function loadBody() {
        require_once CADASTRO_VIEW;
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

    public function register() : bool {
        try {
            $username = $_POST['username'] ?? '';
            $email = $_POST['email'] ?? '';
            $passwd = $_POST['passwd'] ?? '';

            $this->verificarString($username);
            $this->verificarString($email);
            $this->verificarString($passwd);

            $result = $this->registerModel->registerUser($username, $email, $passwd);
            header('Location: /login');

            return $result;
        } catch (Exception $e) {
            echo "Username: ".$username." email: ".$email." senha: ".$passwd."<br>";
            echo "Erro ao registrar usuário: " . $e->getMessage();
        }
        return false;
    }

}