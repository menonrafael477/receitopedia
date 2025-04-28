<?php
    session_start();
    $_SESSION['logado'] = false;
    header("location: index.php");
    exit; 
?>
