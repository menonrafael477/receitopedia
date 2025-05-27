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
            $id_user = $user->get_id();

            if ($this->likeModel->like($id_user, $id_post)) {
                header('Location: /recipe/' . $id_post);
                return true;
            } else {
                echo "Erro: Não foi possível processar o seu like. Por favor, tente novamente.";
                return false;
            }
        } catch(Exception $erro){
            echo "Opa, falha catastrófica! ".$erro->getMessage();
            return false;
        }
    }

    public function addDislike($id_post): bool {
        try {
            $loginController = new LoginController();
            $user = $loginController->getUserBySession();
            $id_user = $user->get_id();

            if ($this->likeModel->dislike($id_user, $id_post)) {
                header('Location: /recipe/' . $id_post);
                return true;
            } else {
                echo "Erro: Não foi possível processar o seu dislike. Por favor, tente novamente. (Verifique se a coluna no DB aceita negativos)";
                return false;
            }
        } catch(Exception $erro){
            echo "Opa, falha catastrófica! ".$erro->getMessage();
            return false;
        }
    }
}