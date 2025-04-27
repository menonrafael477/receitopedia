//<?php
//require('config/db.php');
//require('models/comentario.model.php');

//class ComentarioController {
//    public function adicionarComentario() {
//        $usuarioId = $_SESSION['usuario_id'];
//        $receitaId = $_GET['id'];
//        $textoComentario = $_POST['texto_comentario'];
//        $avaliacao = $_POST['avaliacao']; // 1 para "gostou", -1 para "não gostou", 0 para "neutro"
//        ARRUMAR COM O MODEL
//        $comentarioModel = new Comentario();
//        ARRUMAR COM O MODEL
//        $comentarioModel->adicionarComentario($receitaId, $usuarioId, $textoComentario);
//        ARRUMAR COM O MODEL
//        $avaliacaoModel = new Avaliacao();
//        ARRUMAR COM O MODEL
//        $avaliacaoModel->adicionarAvaliacao($receitaId, $usuarioId, $avaliacao);
//
//    }
//}<?php

class ComentarioController {
    private $db; // Propriedade privada

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=meubanco', 'usuario', 'senha');
    }

    public function adicionarComentario() {
        // Código para adicionar o comentário no banco
        $stmt = $this->db->prepare("INSERT INTO comentarios (texto_comentario) VALUES (:comentario)");
        $stmt->execute([':comentario' => 'Texto do comentário']);
    }
}

?>
