<?php

class BancoDeDados{
    
    private static $banco_de_dados = null;

    private static function conectar_database(){
        if (self::$banco_de_dados != null){
            return;
        }
        
        try{

            self::$banco_de_dados = new mysqli('localhost', 'root', '', 'receitopedia');
            self::$banco_de_dados -> set_charset('utf-8_unicode_ci');
    
        } catch (Exception $erro) {
            throw new Exception('Erro na conexão com o banco de dados: ' . $erro->getMessage());

        }
    }

    public static function get_banco_de_dados(){
        if (self::$banco_de_dados == null){
            self::conectar_database();
        }

        return self::$banco_de_dados;
    }

}
    
?>