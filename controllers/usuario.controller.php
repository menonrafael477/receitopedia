<?php

require_once('models/usuario.model.php');

class UsuarioController {

    public function cadastrarUsuario() {
        try {

            $data = $_POST;// Acessando dados via $_POST

            if (!isset($data['nome'], $data['email'], $data['senha'])) {
                return json_encode(['status' => 'error', 'message' => 'Dados incompletos para cadastro.']);
            }

            $id_usuario = cadastrar_usuario($data['nome'], $data['email'], $data['senha']);

            if ($id_usuario > 0) {
                return json_encode(['status' => 'success', 'message' => 'Usuário cadastrado com sucesso.', 'id_usuario' => $id_usuario]);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Erro ao cadastrar usuário.']);
            }

        } catch (Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function excluirUsuario() {
        try {
            
            $data = $_POST;// Acessando dados via $_POST

            if (!isset($data['email'])) {
                return json_encode(['status' => 'error', 'message' => 'Email não informado para exclusão.']);
            }

            $linhas_afetadas = excluir_usuario_por_email($data['email']);

            if ($linhas_afetadas > 0) {
                return json_encode(['status' => 'success', 'message' => 'Usuário excluído com sucesso.']);
            } else {
                return json_encode(['status' => 'error', 'message' => 'Usuário não encontrado ou não pôde ser excluído.']);
            }

        } catch (Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}

?>
