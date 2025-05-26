<?php

class Database {

    //Variables
    private static $database = null;

    //Static functions
    private static function connectDatabase() : void {
        if (self::$database != null){
            return;
        }

        try {
            self::$database = new PDO(DSN, DB_USER, DB_PASSWD);        
        } catch (PDOException $error){
            die($error->getMessage());
        }   
    }

    public static function getDatabase() : PDO {
        if (self::$database == null){
            self::connectDatabase();
        } 
        
        return self::$database;
    }
}

?>