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
            <div class="main-content bg-report">
                <div class="panel-row">
                    <div class="panel panel-config">
                    <div class="form-group">
                                <label for="type">Formato de Arquivo</label>
                                <select class="custom-select custom-select-sm">
                                    <option selected>Escolha um formato...</option>
                                    <option value="1">.pdf</option>
                                    <option value="2">.scv</option>
                                    <option value="3">.xls</option>
                                </select>
                            </div>
                        <form action="../exportXls.php" method="POST">
                            <div class="form-group">
                                <label for="reportTitle">Título do Relatório</label>
                                <input type="text" name="reportTitle" class="form-control" id="reportTitle"
                                    placeholder="Ex: 'Relatorio da Lavoura de Café'" required>
                            </div>
                            <!--
                            <div class="form-group">
                                <label for="type">Formato de Arquivo</label>
                                <select class="custom-select custom-select-sm">
                                    <option selected>Escolha um formato...</option>
                                    <option value="1">.pdf</option>
                                    <option value="2">.scv</option>
                                    <option value="3">.xls</option>
                                </select>
                            </div>
                            -->
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
                            
                            <button type="button" class="btn"><i class="fas fa-paper-plane"></i>  Enviar para <?php echo $dados['email']; ?></button>
                            
                            <button type="submit" class="btn"><i class="fas fa-download"></i>   Salvar nesse computador</button>
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