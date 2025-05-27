<?php


class ErrorController{

    public function loadGenericError() {
        require GENERIC_ERROR;
        die();
    }

    public function loadPageNotFound() {
        require PAGE_NOT_FOUND;
        die();
    }
}


?>
