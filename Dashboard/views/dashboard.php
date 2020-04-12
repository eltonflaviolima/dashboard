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
        <sidebar>
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
                </ul>
            </div>
        </sidebar>
        <main>
            <header>
                <a href="dashboard.php"><i class="fas fa-chart-line"></i> Dashboard</a>
                <a> Bem vindo <?php echo $dados['nome']; ?>!</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </header>
            <div class="main-content bg-dashboard">
                <div class="panel-row">
                    <div class="panel panel-50" id="grafico">
                       <!-- <canvas class="line=chart" id="myChart"></canvas> -->
                       <form action="" method="post">
                            <div class="form-group">
                                <label for="data">Nome</label>
                                <input type="date" class="form-control" name="data">
    
                                <button type="submit" name="submit" class="btn btn-primary">Buscar</button>
                            </div>
                       </form>

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