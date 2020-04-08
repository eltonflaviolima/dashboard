<?php

    try{
        $HOST = "localhost";
        $BANCO = "nodemcu";
        $USUARIO = "root";
        $SENHA = "";

        $PDO = new PDO("mysql:host=" . $HOST . ";dbname=" .$BANCO . ";charset=utf8", $USUARIO, $SENHA);
        
    }catch (PDOException $error) {
        echo "Erro de conexao, detalhes: " . $erro->getMessage();

    }

?>