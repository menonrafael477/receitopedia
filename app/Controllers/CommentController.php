<?php

class CommentController {
    private $commentModel;
    public function __construct() {
        $this->commentModel = new CommentModel();
    }

    private function verificarString($string) : void{
        if ($string == null){
            throw new Exception("String não pode ser null");
        }
    }

    public function criarComentario() {
        try {
            $id_receita = $_POST['id_receita'];
            $id_usuario = $_POST['id_usuario'];
            $texto_comentario = $_POST['texto_comentario'];

            $this->verificarString($id_receita);
            $this->verificarString($id_usuario);
            $this->verificarString($texto_comentario);

            header('Location: /recipe/' . $id_receita);
            $resultado = $this->commentModel->criarComentario($id_receita, $id_usuario, $texto_comentario);
            return $resultado;
        } catch(Exception $e) {
            echo "Erro ao adicionar comentario: " . $e->getMessage();
        }
    }

    public function buscarComentariosPorReceita($id_receita) {
        try {
            $comentarios = $this->commentModel->buscarComentariosPorReceita($id_receita);
            return $comentarios;
        } catch(Exception $e) {
            echo "Erro ao carregar comentarios: " . $e->getMessage();
        }
    }
}