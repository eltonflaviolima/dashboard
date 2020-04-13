<?php
    //Conexão
    require_once('conexao.php');

    //Sessão
    session_start();

    //Botão entrar
    if(isset($_POST['btn-entrar'])):
        $login = mysqli_escape_string($conexao, $_POST['login']);
        $senha = mysqli_escape_string($conexao, $_POST['senha']);

        if(empty($login)):
            $errosLogin[] = "<p>O campo login deve ser preenchido!</p>";
        else:
            $sql = "SELECT login FROM usuario WHERE login = '$login'";
            $resultado = mysqli_query($conexao, $sql);

            if(mysqli_num_rows($resultado) > 0):
                $senha = md5($senha);
                $sql = "SELECT * FROM usuario WHERE login = '$login' AND senha = '$senha'";
                $resultado = mysqli_query($conexao, $sql);

                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    //Configurações padrão
                    $_SESSION['titulo'] = 'Registro de Pressão';
                    $_SESSION['corLinha'] = '#C65E37';
                    $_SESSION['corFundo'] = 'rgba(198, 93, 55, 0.507)';
                    $_SESSION['lineWidht'] = 3;
                    $_SESSION['tabela'] = false;
                    $_SESSION['tipoGrafico'] = 'line';
                    header('Location: views/dashboard.php');
                else:
                    $errosSenha[] = "<p>Os dados não conferem!</p>";
                endif;
            else:
                $errosLogin[] = "<p>Login inxestente!</p>"; 
            endif;
        endif;
        
        if(empty($senha)):
            $errosSenha[] = "<p>O campo senha deve ser preenchidos!</p>";
        endif;
    endif;
?>

<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--Import all.css-->
    <link rel="stylesheet" href="css/all.css">

    <!--Import bootstrap.css-->
    <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

    <!--Import fontawesome.css-->
    <link rel="stylesheet" href="plugins/fontawesome/css/all.min.css">

    <title>Tensiômetro | Login</title>
</head>

<body>
    <div class="login">
        <div class="login-form">
            <img src="images/logo-tech-tensiometro.png" alt="">
            <div class="login-form-wrapper">
                <div class="login-title">
                    <h2>Login</h2>
                    <a href="views/register.php">Inscrever-se</a>
                </div>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text"  name="login" class="form-control is-invalid" id="login" placeholder="Digite seu login">
                    <div class="invalid-feedback">
                    <?php
                    //erro login
                        if(!empty($errosLogin)):
                            foreach($errosLogin as $erroLogin):
                                echo $erroLogin;
                            endforeach;
                        endif;
                    ?>
                    </div>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" class="form-control is-invalid" id="senha" placeholder="Senha">
                        <div class="invalid-feedback">
                        <?php
                        //erro senha
                            if(!empty($errosSenha)):
                                foreach($errosSenha as $erroSenha):
                                    echo $erroSenha;
                                endforeach;
                            endif;
                        ?>
                        </div>
                    </div>
                    <button type="submit" name="btn-entrar" class="btn">Entrar</button>
                </form>
            </div>
        </div>
        <div class="banner-login">
            <img src="images/foto-capa.png" alt="">
        </div>
    </div>

    <!--Import bootstrap.js-->
    <script src="plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Import fontawesome.js-->
    <script src="plugins/fontawesome/js/all.min.js"></script>
</body>

</html>