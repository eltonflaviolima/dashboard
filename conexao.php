<?php

    try{
        $hostname = "localhost";
        $database = "nodemcu";
        $user = "root";
        $password = "";
        $PDO = new PDO("mysql:host=" . $hostname . ";dbname=" . $database . ";charset=utf8");

    }catch (PDOException $error) {
        echo "Erro de conexao, detalhes: " . $erro->getMessage();

    }

?>