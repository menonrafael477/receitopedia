<?php

require('models/usuario.model.php'); 
require('views/cadastro.view.php');

class UsuarioController {
    public function cadastrarUsuario() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome= $_POST['email'] ?? '';
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            try {

                //$data = $_POST;// Acessando dados via $_POST

                //if (!isset($data['nome'], $data['email'], $data['senha'])) {
                //    return json_encode(['status' => 'error', 'message' => 'Dados incompletos para cadastro.']);
                //}

                $id_usuario = cadastrar_usuario($nome, $email, $senha);

                if ($id_usuario > 0) {
                    header('Location: cadastro.view.php?cadastro_sucesso=true');// Redireciona de volta com um sucesso
                    exit;                
                } else {
                    header('Location: cadastro.view.php?cadastro_erro=true');// Redireciona de volta com erro
                    exit;
                }

            } catch (Exception $e) {// Redireciona de volta com um erro e uma mensagem
                header('Location: cadastro.view.php?cadastro_erro=true&mensagem=' . urlencode($e->getMessage()));
                exit;
            }
        } else {
            header('Location: cadastro.view.php');// Se não for POST, redireciona para o formulário
            exit;
        }
    }

    public function excluirUsuario() {    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;

            if ($email === null) {
                echo json_encode(['status' => 'error', 'message' => 'Email não informado para exclusão.']);
                return;
            }
            try {
                $linhas_afetadas = excluir_usuario_por_email('$email');

                if ($linhas_afetadas > 0) {//se der erro troca return por echo
                    return json_encode(['status' => 'success', 'message' => 'Usuário excluído com sucesso.']);
                } else {//se der erro troca return por echo
                    return json_encode(['status' => 'error', 'message' => 'Usuário não encontrado ou não pôde ser excluído.']);
                }

            } catch (Exception $e) {
                return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }else{
            echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido para exclusão.']);
        }
    }
}

?>
