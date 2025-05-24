<?php

class Database {

    //Variables
    private static $database = null;

    //Static functions
    public static function ConnectDatabase() : void {
        if (self::$database != null){
            throw new Exception("Banco de Dados já conectado.");
        }

        try {
            self::$database = new PDO('mysql:host = localhost; dbname = receitopedia', 'root', '');        
        } catch (PDOException $error){
            die($error->getMessage());
        }

        print_r("Conexão realizada com sucesso");
    }

    public static function GetDatabase() : PDO {
        if (self::$database == null){
            throw new Exception("Não existe nenhum banco de dados conectado.");
        }
        return self::$database;
    }
}

?>