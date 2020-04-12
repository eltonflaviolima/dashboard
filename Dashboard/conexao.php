<?php
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'tech_tensiometro';
    $conexao = mysqli_connect($hostname, $username, $password, $dbname);

    if(mysqli_connect_error()):
        echo "Falha na conexão com o banco de dados!";
    endif;