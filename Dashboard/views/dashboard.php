<?php
    //Conexão
    require_once('../conexao.php');

    //Sessão
    session_start();

    //Verificação de sessão
    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    //Dados
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    //Dados Sensor
    //TODO rever essas pesquisas
    date_default_timezone_set('America/Sao_Paulo');
    if(isset($_POST['pesquisar'])):
        $dataPesquisa = mysqli_escape_string($conexao, $_POST['data']);
        $dataArray = explode("-", $dataPesquisa);
        $dataPesquisa = $dataArray[0] . "-" . $dataArray[1];
        $sqlSensor = "SELECT * FROM sensor WHERE data_hora LIKE '%" . $dataPesquisa . "%'";
        $resultadoSensor = mysqli_query($conexao, $sqlSensor);

    else: 
        $sqlSensor = "SELECT * FROM sensor";
        $resultadoSensor = mysqli_query($conexao, $sqlSensor);
    endif;

    if(isset($_POST['intervalo'])):
        $dataStart = mysqli_escape_string($conexao, $_POST['start']);
        $dataArray = explode("-", $dataStart);
        $dataStart = $dataArray[0] . "-" . $dataArray[1] . "-" . $dataArray[2];
        $dataEnd = mysqli_escape_string($conexao, $_POST['end']);
        $dataArray = explode("-", $dataEnd);
        $dataEnd = $dataArray[0] . "-" . $dataArray[1] . "-" . $dataArray[2];
        $sqlSensor = "SELECT * FROM sensor WHERE data_hora BETWEEN '%" . $dataStart . "%' AND '%" . $dataEnd . "%'";
        $resultadoSensor = mysqli_query($conexao, $sqlSensor);

    else:
        $sqlSensor = "SELECT * FROM sensor";
        $resultadoSensor = mysqli_query($conexao, $sqlSensor);
    endif;
?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Import all.css-->
    <link rel="stylesheet" href="../css/all.css">

    <!--Import bootstrap.css-->
    <link rel="stylesheet" href="../plugins/bootstrap/css/bootstrap.min.css">

    <!--Import fontawesome.css-->
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">

    <title>Tensiômetro | Dashboard</title>
</head>

<body>
    <div class="flex-dashboard">
        <sidebar id="sidebar">
            <div class="sidebar-title">
                <img src="../images/logo-tech-tensiometro.png" alt="">
                <h2>Tensiômetro</h2>
            </div>
            <div class="menu">
                <ul>
                    <li>
                        <i class="fas fa-chart-line"></i>
                        <a href="dashboard.php">DASHBOARD</a>
                    </li>
                    <li>
                        <i class="far fa-clipboard"></i>
                        <a href="relatorios.php">RELATÓRIOS</a>
                    </li>
                    <li>
                        <i class="fas fa-cog"></i>
                        <a href="configuracoes.php"></i>CONFIGURAÇÕES</a>
                    </li>
                    <li>
                        <i class="fas fa-plus"></i>
                        <a href="cadsensor.php"></i>ADICIONAR </a>
                    </li>
                    <li class="sidebar-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="../logout.php"></i>Logout </a>
                    </li>
                </ul>
            </div>
        </sidebar>
        <main id="mainContent">
            <header>
                <!-- Criar função para esconder sidebar -->
                <i id="iconMenu" onclick="responsiveSidebar()" class="fas fa-bars"></i>
                <a> Bem vindo <?php echo $dados['nome']; ?>!</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </header>
            <div class="main-content bg-dashboard">
                <div class="panel-row">
                    <div class="panel panel-50" id="grafico">
                       <!-- <canvas class="line=chart" id="myChart"></canvas> -->
                       <form action="" method="post">
                            <div class="form-group">
                                <label for="data">Filtrar registros por mês</label>
                                <input type="month" class="form-control" name="data">
                                <button type="submit" name="pesquisar" class="btn btn-primary">Buscar</button>
                            </div>
                       </form>
                       <form action="" method="post">

                            <div class="row">
                                <div class="col-6">
                                    <label for="start">Desde</label>
                                    <input type="date" name="start" class="form-control" id="start">
                                </div>
                                <div class="col-6">
                                    <label for="end">Até</label>
                                    <input type="date" name="end" class="form-control" id="end">
                                </div>
                            </div>
                            
                            <button type="submit" name="intervalo" class="btn btn-primary">Buscar</button>
                       </form>

                       <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Pressão</th>
                            <th scope="col">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
            
                            while($dadosSensor = mysqli_fetch_array($resultadoSensor)):
                                echo '<tr><th scope="row">';
                                echo $dadosSensor['id'];
                                echo '</th><td>';
                                echo $dadosSensor['mpx'];
                                echo '</td><td>';
                                echo $dadosSensor['data_hora'];
                                echo '</td></tr>';
                            endwhile;
                            ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </main>
    </div>
    <!--Import bootstrap.js-->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Import fontawesome.js-->
    <script src="../plugins/fontawesome/js/all.min.js"></script>

    <!--Import chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <!--Import jquery.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--Import custom chart.js-->
    <script src="../js/charts.js"></script>

</body>

</html>