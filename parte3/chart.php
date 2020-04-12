<?php

try{
    $HOST = "localhost";
    $BANCO = "nodemcu";
    $USUARIO = "root";
    $SENHA = "";

    $pdo = new PDO("mysql:host=" . $HOST . ";dbname=" .$BANCO . ";charset=utf8", $USUARIO, $SENHA);
    
}catch (PDOException $error) {
    echo "Erro de conexao, detalhes: " . $erro->getMessage();

}

$sql = "SELECT tensiometro.sensorPressao, tensiometro.data FROM tensiometro";

$stmt = $pdo->prepare($sql);

$stmt->execute();

while($results = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $result[] = $results;
}

echo json_encode($result);
?>

