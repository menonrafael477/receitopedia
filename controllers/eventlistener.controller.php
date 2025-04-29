<?php
    //var_dump($_GET);
    //require('views/login.view.php');
    //require('models/login.model.php');

    //require('logout.controller.php');
    #require('avaliacao.controller.php');
    #require('comentario.controller.php');
    #require('like.controller.php');
    //require('login.controller.php');
    #require('logout.controller.php');
    #require('receita.controller.php');
    require('receitopedia.controller.php');//mudei
    #require('session.controller.php');
    #require('usuario.controller.php');

  
    $login_controller_event = new LoginController();
    $receitopedia_controller_event = new ReceitopediaController();//mudei
    #$logout_controller_event = new LogoutController();
    #$receita_controller_event = new ReceitaController();
    #$session_controller_event = new SessionController();
    #$usuario_controller_event = new UsuarioController();
    
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        
        echo json_encode("usuario realizou acao");

        //var_dump($_SESSION);
        
        switch ($action) {
            # Login controller
            
            //case 'login':
             //   $login_controller_event->login_usuario();
             //   return  (['status' => 'error', 'message' => "Login: /'$action'"]);

            # Logout controller
            //case 'logout':
                //$logout_controller_event->logoff_user();
                //return (['status' => 'error', 'message' => "Logout: '$action'"]);

            # Receita controller
            case 'get_receita':
                #echo $receita_controller_event->getReceita();
                return (['status' => 'error', 'message' => "Get receita: '$action'"]);
            case 'create_receita':
                #echo json_encode($receita_controller_event->criarReceita());
                return (['status' => 'error', 'message' => "Create receita: '$action'"]);
            case 'update_receita':
                #echo json_encode($receita_controller_event->atualizarReceita());
                return (['status' => 'error', 'message' => "Atualizar receita: '$action'"]);
            case 'delete_receita':
                #echo json_encode($receita_controller_event->excluirReceita());
                return (['status' => 'error', 'message' => "Excluir receita: '$action'"]);

            # Session controller
            case 'session':
                #$session_controller_event->session_verify();
                return (['status' => 'error', 'message' => "Session: '$action'"]);

            # Usuario controller
            case 'cadastrar_usuario':
                #echo json_encode($usuario_controller_event->cadastrarUsuario());
                return (['status' => 'error', 'message' => "Cadastrar usuario: '$action'"]);
            case 'excluir_usuario':
                #$usuario_controller_event->excluirUsuario();
                return (['status' => 'error', 'message' => "Excluir usuario: '$action'"]);
            case 'listar_receitas':
                // aqui você chama o método que carrega todas as receitas
                // por exemplo:
                $receitopedia_controller_event->listarReceitas();
                exit; // interrompe o fluxo para não cair no default
            # Default
            default:
                echo json_encode(['status' => 'error', 'message' => "Falha catastrofica: '$action'"]);
        }


    } else {
        return (['status' => 'error', 'message' => 'Acao nao definida']);
    }

?>