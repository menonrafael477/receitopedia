<?php

class Main {

    public function __construct() {
        $this->loadDatabase();
    }

    private function loadDatabase() {
        require_once('Database.php');
        Database::ConnectDatabase();
    }
}


