<?php

    include('conection.php');

    $sensorPressao = $_GET['sensorPressao'];

    $sql = "INSERT INTO tensiometro (sensorPressao) VALUES (:sensorPressao)";

    $stmt = $PDO->prepare($sql);

    $stmt->bindParam(':sensorPressao', $sensorPressao);

    if($stmt->execute()){
        echo "salvo_com_sucesso";
    }else{
        echo "erro_ao_salvar";
    }

?>