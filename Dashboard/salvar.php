<?php

    include('conexao.php');

    $mpx = $_GET['mpx'];

    $sql = "INSERT INTO sensor (`mpx`) VALUES ('$mpx')";
    $resultado = mysqli_query($conexao, $sql);

    if($resultado){
        echo "salvo_com_sucesso";
    }else{
        echo "erro_ao_salvar";
    }

?>