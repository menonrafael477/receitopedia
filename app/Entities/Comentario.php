<?php

class Comentario {
    private $id;
    private $id_receita;
    private $id_usuario;
    private $texto_comentario;
   
    public function __construct($id, $id_receita, $id_usuario, $texto_comentario) {
        $this -> id               = $id;
        $this -> id_receita       = $id_receita;   
        $this -> id_usuario       = $id_usuario;
        $this -> texto_comentario = $texto_comentario;
    }

     public function getId() {
        return $this->id;
    }
    public function getIdReceita() {
        return $this->id_receita;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getTextoComentario() {
        return $this->texto_comentario;
    }
}

?>