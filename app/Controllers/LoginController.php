<?php

class LoginController {
    use PageLoader;
    private $loginModel;  


    public function __construct() {
        $this->loginModel = new LoginModel();
    }

    private function loadBody() {
        require_once LOGIN_VIEW;
    }

    public function loadPageContent() {
        $this->loadHeader();
        $this->loadBody();
        $this->loadFooter();
    }

}