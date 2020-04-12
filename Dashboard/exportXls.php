<?php
    //Conexão
    require_once('conexao.php');

    //Sessão
    session_start();

    //Verificação de sessão
    if(!isset($_SESSION['logado'])):
        header('Location: index.php');
    endif;

    //Pegando todos os dados
    $sqlSensor = "SELECT * FROM sensor";
    $resultadoSensor = mysqli_query($conexao, $sqlSensor);
    
    $titulo = $_POST['reportTitle'];
    $start = $_POST['start'];
    $end = $_POST['end'];

    //Armazenando em .xls
    $arqXls = '<meta charset = "UTF-8">';
    $arqXls .= '<h2>Tech Tensiômetro</h2>';
    $arqXls .= '<p>Autor: Elton Flávio de Andrade Lima</p>';
    $arqXls .= '<p>IFES - LINHARES</p>';
    $arqXls .= '<h1>';
    $arqXls .= $titulo;
    $arqXls .= '</h1>';
    $arqXls .= '<label>Data inicial:</label>';
    $arqXls .= '<p>';
    $arqXls .= $start;
    $arqXls .= '</p>';
    $arqXls .= '<label>Data final:</label>';
    $arqXls .= '<p>';
    $arqXls .= $end;
    $arqXls .= '</p>';
    $arqXls .= '<table class="table table-hover"><thead><tr><th scope="col">ID</th><th scope="col">Pressão</th><th scope="col">Data e Hora</th></tr></thead><tbody>';
            
    while($dadosSensor = mysqli_fetch_array($resultadoSensor)):
        $arqXls .= '<tr><th scope="row">';
        $arqXls .= $dadosSensor['id'];
        $arqXls .= '</th><td>';
        $arqXls .= $dadosSensor['mpx'];
        $arqXls .= 'kPA</td><td>';
        $arqXls .= $dadosSensor['data_hora'];
        $arqXls .= '</td></tr>';
    endwhile;
            
    $arqXls .= '</tbody></table>';
    header("Content-Type: application/xls");
    header("Content-Disposition:attachment; filename =$titulo.xls");
    echo $arqXls;
?>