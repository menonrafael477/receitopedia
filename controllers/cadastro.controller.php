<?php


require('views/cadastro.view.php');

class UsuarioController {
    public function cadastrarUsuario() {
        require('models/cadastro.model.php'); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome  = $_POST['nome']  ?? null;
            $email = $_POST['email'] ?? null;
            $senha = $_POST['senha'] ?? null;

            try {
                cadastrar_usuario($nome, $email, $senha);
                header("Location: login.php");
                return(['status' => 'success', 'message' => "Usuario cadastrado!"]);
            } catch (Exception $erro) {
                return(['status' => 'error', 'message' => "Erro ao cadastrar o usuário! '$erro'"]);
            }              

        } else {
            echo json_decode("ERRO CATASTROFICO!!!!!!!!!!!!!!!!!");
            return(['status' => 'error', 'message' => 'Método de requisição inválido.']);
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

$usuario_controller = new UsuarioController();

if(isset($_GET['action_cadastro'])) {
    $action = $_GET['action_cadastro'];
    
    //echo json_encode("usuario realizou acao no Cadastro Controller action: '$action'");

    switch ($action) {
        case 'cadastro':
            $usuario_controller -> cadastrarUsuario();
            return (['status' => 'success', 'message' => "Cadastrar usuario: '$action'"]);
      
        default:
            echo json_encode(['status' => 'error', 'message' => "Falha catastrofica: '$action'"]);
    }


} else {
    return (['status' => 'error', 'message' => 'Acao nao definida']);
}


?>
