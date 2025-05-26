<?php

class Usuario {

    private string $nome;
    private int $id;
    private string $email;
    private bool $isAdmin;

    public function __construct($id, $nome, $email, $isAdmin) {
        $this -> id     = $id;
        $this -> nome   = $nome;
        $this -> email  = $email;
        $this -> $isAdmin = $isAdmin;
    }

    public function get_nome() : string {
        return $this -> nome;
    }

    public function get_email() : string {
        return $this -> email;
    }

    public function get_id() : int {
        return $this -> id;
    }

    public function isAdmin() : bool {
        return $this -> isAdmin;
    }

}

?>