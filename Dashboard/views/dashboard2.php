<?php
    //Conexão
    require_once('../conexao.php');
    require_once('../plugins/converte.php');

    //Sessão
    session_start();

    //Verificação de sessão
    if(!isset($_SESSION['logado'])):
        header('Location: ../index.php');
    endif;

    //Dados de usuario
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuario WHERE id = '$id'";
    $resultado = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_array($resultado);

    //Dados Sensor Gráfico
    date_default_timezone_set('America/Sao_Paulo');
    $listaSensor = array();
    $listaData = array();
    $i = 0;
    $sqlGrafico = "SELECT * FROM sensor";
    $resultadoGrafico = mysqli_query($conexao, $sqlGrafico);
    while($row = mysqli_fetch_object($resultadoGrafico)) {
        $mpx = $row->mpx;
        $data_hora = $row->data_hora;
        $data_hora_formatada = date("H", strtotime($data_hora));
        $listaSensor[$i] = $mpx;
        $listaData[$i] = $data_hora_formatada;
        $i = $i + 1;
    }

    //Dados Sensor Tabela
    $sqlSensor = "SELECT * FROM sensor";
    $resultadoSensor = mysqli_query($conexao, $sqlSensor);
    
    //Configurações de usuário
    if(isset($_POST['corLinha'])):
        $_SESSION['corLinha'] = $_POST['corLinha'];
    endif;
    
    if(isset($_POST['corFundo'])):
        $_SESSION['corFundo'] = hex2rgba($_POST['corFundo'], 0.5);
    endif;
    
    if(isset($_POST['lineWidht'])):
        $_SESSION['lineWidht'] = $_POST['lineWidht'];
    endif;
    
    if(isset($_POST['chartTitle'])):
        $_SESSION['titulo'] = $_POST['chartTitle'];
    endif;
    
    if(isset($_POST['table'])):
        $_SESSION['tabela'] = true;
    else:
        $_SESSION['tabela'] = false;
    endif;
    
    if(isset($_POST['tipoGrafico'])):
        $_SESSION['tipoGrafico'] = $_POST['tipoGrafico'];
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
<div class="flex-dashboard" id="wrapper">

<!-- Sidebar -->
<sidebar>
<div class="sidebar" id="sidebar-wrapper">
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
            <a href="../logout.php"></i>LOGOUT </a>
        </li>
    </ul>
  </div>
</div>
</sidebar>
<!-- /#sidebar-wrapper -->

<!-- Page Content -->
<main>
<div id="page-content-wrapper">

  <header>
      <nav>
    <button class="btn btn-primary" id="menu-toggle">
      <span class="navbar-toggler-icon"></span>
    </button>
</nav>
  </header>

  <div class="main-content bg-dashboard">
    <div class="panel-row">
      <h1><?php echo $_SESSION['titulo'] ?></h1>
      <canvas id="myChart" style="widht: 600px;"></canvas>
  </div>
  <div class="panel-row">
      <div class="panel panel-50" id="grafico">
      <?php
      if($_SESSION['tabela']): echo '
         <table class="table table-hover">
          <thead>
              <tr>
              <th scope="col">ID</th>
              <th scope="col">Pressão</th>
              <th scope="col">Data e Hora</th>
              </tr>
          </thead>
          <tbody>';
              
              while($dadosSensor = mysqli_fetch_array($resultadoSensor)):
                  echo '<tr><th scope="row">';
                  echo $dadosSensor['id'];
                  echo '</th><td>';
                  echo $dadosSensor['mpx'];
                  echo 'kPa</td><td>';
                  echo $dadosSensor['data_hora'];
                  echo '</td></tr>';
              endwhile;
          echo '
              </tbody>
          </table>
          '; endif; ?>
    </div>
  </div>
            </main>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->
    <!--Import bootstrap.js-->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Import fontawesome.js-->
    <script src="../plugins/fontawesome/js/all.min.js"></script>

    <!--Import chart.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>

    <!--Import jquery.js-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!--Import custom chart.js-->
    <script src="../js/menu.js"></script>

    <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>

    <script type="text/javascript">
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
        var dados[]
            // Tipo de gráfico
            type: '<?php echo $_SESSION['tipoGrafico'] ?>',

            // Dados do gráfico
            data: {
                labels: [
                    <?php
                    $k = $i;
                    for($i = (count($listaSensor) - 7); $i < count($listaSensor); $i++){
                    ?>'<?php echo $listaData[$i] ?>h',<?php } ?>
                ],
                datasets: [{
                    label: false,
                    backgroundColor: '<?php echo $_SESSION['corFundo'] ?>',
                    borderWidth: <?php echo $_SESSION['lineWidht'] ?>,
                    borderColor: '<?php echo $_SESSION['corLinha'] ?>',
                    data: dados [
                        <?php
                        $k = $i;
                        for($i = (count($listaSensor) - 7); $i < count($listaSensor); $i++){
                        ?><?php echo $listaSensor[$i] ?>,<?php } ?>
                    ]
                }]
            },

            // Configurações do gráfico
            options: {
                scales: {
                    xAxes: [{
                        gridLines: {
                            drawOnChartArea: true
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            max: 90,
                            min: 0,
                            stepSize: 15
                        },
                        gridLines: {
                            drawOnChartArea: true
                        }
                    }]
                },
                legend: {
                    display: false
                },
                tooltips: {
                    callbacks: {
                    label: (item) => `${item.yLabel} kPa`,
                    },
                },
            }  
        });
        function addValor() {
            chart.data.datasets.data.push("<?php echo $listaSensor[$i] ?>");
            chart.update();
        }
    </script>
</body>

</html>