<?php

class Receita {
    private $id;
    private $titulo_receita;
    private $texto_receita;
    private $foto_receita;
    private $categoria;
    private $likes;
    private $dislikes;


    public function __construct($id, $titulo_receita, $texto_receita, $foto_receita, $categoria, $likes, $dislikes) {
        $this -> id             = $id;
        $this -> titulo_receita = $titulo_receita;
        $this -> texto_receita  = $texto_receita;
        $this -> foto_receita   = $foto_receita;
        $this -> categoria      = $categoria;
        $this -> likes          = $likes;
        $this -> dislikes       = $dislikes;
    }
    public function getId() {
        return $this->id;
    }

    public function getTituloReceita() {
        return $this->titulo_receita;
    }

    public function getTextoReceita() {
        return $this->texto_receita;
    }

    public function getFotoReceita() {
        return $this->foto_receita;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function getLikes() {
        return $this->likes;
    }

    public function getDislikes() {
        return $this->dislikes;
    }
}
?>
