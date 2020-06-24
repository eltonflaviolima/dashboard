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
        <sidebar id="sidebar">
            <div class="sidebar-title">
                <img src="../images/logo-tech-tensiometro.png" alt="" id="iconMenu" onclick="responsiveSidebar()">
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
                        <a href="../logout.php"></i>LOGOUT </a>
                    </li>
                </ul>
            </div>
        </sidebar>
        <main id="mainContent">
            <header>
                <!-- Criar função para esconder sidebar -->
                <i id="iconMenu" onclick="responsiveSidebar()" class="fas fa-bars"></i>
                <!--<a> Bem vindo <?php echo $dados['nome']; ?>!</a>
                <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>-->
            </header>
            <div class="main-content bg-config">
                <div class="panel-row">
                    <div class="panel panel-config">
                    <form action="dashboard.php" method="POST">
                        <div class="form-group">
                            <label for="limite">Limite de Pressão</label>
                            <input type="number" name="limitePressao" class="form-control" id="limite" placeholder="Limite da pressão para ativar a irrigação">
                        </div>
                        <div class="form-group">
                            <label for="chartTitle">Título do Gráfico</label>
                            <input type="text" name="chartTitle" class="form-control" id="chartTitle" placeholder="Ex: 'Pressão Café'">
                        </div>
                        <div class="form-group">
                            <label for="type">Tipo de Gráfico</label>
                            <select name="tipoGrafico" class="custom-select custom-select-sm">
                                <option selected value="line">Linha</option>
                                <option value="bar">Barra</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="lineWidht">Largura da Linha</label>
                            <input type="range" name="lineWidht" class="custom-range" min="0" max="7" id="lineWidht">
                        </div>
                        <div class="form-group">
                            <label for="corLinha">Cor do Gráfico</label>
                            <input type="color" name="corLinha" class="form-control mx-auto" value="#C65E37" id="corLinha">
                        </div>
                        <div class="form-group">
                            <label for="corFundo">Cor de Fundo</label>
                            <input type="color" name="corFundo" class="form-control mx-auto" value="#C65E37" id="corFundo">
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="table" class="custom-control-input" id="tabela">
                            <label class="custom-control-label" for="tabela">Exibir Tabela</label>
                        </div>


                        <button type="submit" class="btn"><i class="fas fa-paint-brush"></i>   Salvar configurações</button>
                    </form>
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

    <script src="../js/menu.js"></script>

</body>

</html>