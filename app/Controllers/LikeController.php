<?php

class LikeController {
    private $likeModel;

    public function __construct() {
        $this->likeModel = new LikeModel();
    }

    public function getLikes($id_post) {
        return $this->likeModel->getLikeCounts($id_post);
    }

    public function addLike($id_post): bool {
        try {
            $loginController = new LoginController();
            $user = $loginController->getUserBySession();

            if ($user) {
                $id_user = $user->get_id();

                if ($this->likeModel->like($id_user, $id_post)) {
                    header('Location: /recipe/' . $id_post);
                    return true;
                } else {
                    echo "Erro: Não foi possível processar o seu like. Por favor, tente novamente.";
                    return false;
                }
            } else {
                //Dar load em uma div que fiz para logar ou registrar
                header('Location: /login');
                return true;
            }


        } catch(Exception $erro){

            //new ReceitaController()->loadPageContentRecipe($id_post);
            echo "Opa, falha catastrófica! ".$erro->getMessage();
            return false;
        }
    }

    public function addDislike($id_post): bool {
        try {
            $loginController = new LoginController();
            $user = $loginController->getUserBySession();

            if ($user != null) {
                $id_user = $user->get_id();

                if ($this->likeModel->dislike($id_user, $id_post)) {
                    header('Location: /recipe/' . $id_post);
                    return true;
                } else {

                    //new ReceitaController()->loadPageContentRecipe($id_post);
                    echo "Erro: Não foi possível processar o seu dislike. Por favor, tente novamente. (Verifique se a coluna no DB aceita negativos)";
                    return false;
                }
            } else {
                //Dar load em uma div que fiz para logar ou registrar
                header('Location: /login');
                return true;
            }

        } catch(Exception $erro){
            echo "Opa, falha catastrófica! ".$erro->getMessage();
            return false;
        }
    }
}