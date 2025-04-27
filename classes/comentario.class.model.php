<?php

class Comentario {
    private $texto;
    private $id_post;
    private $id_usuario;

    public function __construct($texto, $id_post, $id_usuario) {
        $this -> texto = $texto;
        $this -> id_post = $id_post;
        $this -> id_usuario = $id_usuario;

    }


    
}


?>
