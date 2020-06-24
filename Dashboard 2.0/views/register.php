<?php
    //Conexao
    require_once('../conexao.php');

    //Botão cadastrar
    if(isset($_POST['btn-cadastrar'])):
        $nome = ucwords(mysqli_escape_string($conexao, $_POST['nome']));
        $email = mysqli_escape_string($conexao, $_POST['email']);
        $login = mysqli_escape_string($conexao, $_POST['login']);
        $senha = md5(mysqli_escape_string($conexao, $_POST['senha']));

        if(empty($nome) or empty($email) or empty($login) or empty($senha)):
            $erros[] = '<div class="alert alert-danger" role="alert">Preencha todos os dados!</div>';
        else:
            $sql = "INSERT INTO usuario (`nome`, `email`, `login`, `senha`) VALUES ('$nome', '$email', '$login', '$senha')";
            $resultado = mysqli_query($conexao, $sql);
            header('Location: ../index.php');
        endif;
            
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

    <title>Tensiômetro | Registro</title>
</head>

<body> 
    
    <div class="register-parent">
        
        <div class="register">
            <div class="register-title">
                <img class="bg-img" src="../images/logo-tech-tensiometro.png" alt="">
                <h2>Tech Tensiômetro</h2>
            </div>
            
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <!--    Mensagem de erro    -->    
            <?php
                if(!empty($erros)):
                    foreach($erros as $erro):
                        echo $erro;
                    endforeach;
                endif;
            ?>
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" id="name" placeholder="Digite seu nome completo">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                    placeholder="Digite um email válido">
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" name="login" class="form-control" id="login" placeholder="Crie o seu login">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha">
                </div>
                <button type="submit" name="btn-cadastrar" class="btn">Cadastrar</button>
                <p>Já é cadastrado?<a href="../index.php">Clique aqui!</a></p>
            </form>
        </div>
    </div>

    <!--Import bootstrap.js-->
    <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>

    <!--Import fontawesome.js-->
    <script src="../plugins/fontawesome/js/all.min.js"></script>
</body>

</html>