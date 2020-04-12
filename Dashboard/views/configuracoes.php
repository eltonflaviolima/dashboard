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

    <!--Import fontawesome.css-->
    <link rel="stylesheet" href="../plugins/Chart.js-2.9.3/dist/Chart.min.css">

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
                    <li class="sidebar-logout">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="../logout.php"></i>Logout </a>
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
            <div class="main-content bg-config">
                <div class="panel-row">
                    <div class="panel panel-config">
                        <div class="form-group">
                            <label for="chartTitle">Título do Gráfico</label>
                            <input type="text" class="form-control" id="chartTitle" placeholder="Ex: 'Pressão Café'">
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo de Gráfico</label>
                            <select class="custom-select custom-select-sm">
                                <option selected>Tipo de Gráfico</option>
                                <option value="1">Linha</option>
                                <option value="2">Barra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lineWidht">Largura da Linha</label>
                            <input type="range" class="custom-range" min="0" max="5" id="lineWidht">
                        </div>
                        <div class="form-group">
                            <label for="corLinha">Cor do Gráfico</label>
                            <input type="color" class="form-control mx-auto" id="corLinha">
                        </div>
                        <div class="form-group">
                            <label for="corFundo">Cor de Fundo</label>
                            <input type="color" class="form-control mx-auto" id="corFundo">
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="grid">
                            <label class="custom-control-label" for="grid">Grid habilitado</label>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!--Import bootstrap.js-->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Import fontawesome.js-->
    <script src="../plugins/fontawesome/js/all.min.js"></script>

    <script src="../plugins/Chart.js-2.9.3/dist/Chart.min.js"></script>

    <script src="../js/charts.js"></script>

</body>

</html>