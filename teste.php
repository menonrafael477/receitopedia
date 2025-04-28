<?php

    //require('config/db.php');

    $nome  = 'Gabriel Capri';
    $email = 'Gabriel@gmail.com';
    $senha = 'Soubobo123';

    $banco_de_dados = BancoDeDados::get_banco_de_dados();

    $banco_de_dados -> query("INSERT INTO usuario (nome, email, senha) VALUES ('$nome','$email','$senha')");

    $id = $banco_de_dados -> insert_id;

    echo "O id é: '$id'";

?>