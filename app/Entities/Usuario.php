<?php

class Usuario {

    private string $nome;
    private int $id;
    private string $email;

    public function __construct($id, $nome, $email) {
        $this -> id     = $id;
        $this -> nome   = $nome;
        $this -> email  = $email;
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
}

?>