<?php
    //Conexao
    require_once('../conexao.php');

    //Botão cadastrar
    date_default_timezone_set('America/Sao_Paulo');
    if(isset($_POST['btn-cadastrar'])):
        $mpx = mysqli_escape_string($conexao, $_POST['mpx']);

        if(empty($mpx)):
            $erros[] = '<div class="alert alert-danger" role="alert">Preencha todos os dados!</div>';
        else:
            $sql = "INSERT INTO sensor (`mpx`) VALUES ('$mpx')";
            $resultado = mysqli_query($conexao, $sql);
            header('Location: dashboard.php');
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
    
        <title>Tensiômetro | Cadastrar Pressão</title>
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
                        <label for="mpx">Pressão</label>
                        <input type="text" name="mpx" class="form-control" id="mpx" placeholder="Digite o valor da pressão">
                    </div>
                    <button type="submit" name="btn-cadastrar" class="btn">Cadastrar</button>
                </form>
            </div>
        </div>
    
        <!--Import bootstrap.js-->
        <script src="../plugins/bootstrap/js/bootstrap.min.js"></script>
    
        <!--Import fontawesome.js-->
        <script src="../plugins/fontawesome/js/all.min.js"></script>
    </body>
    
    </html>