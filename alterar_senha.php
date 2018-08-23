<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="vendor/jquery/jquery.min.js"></script>
    <title>Portal RH</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 54px;
        }
        @media (min-width: 992px) {
            body {
                padding-top: 56px;
            }
        }

    </style>

  </head>

  <body style="padding-top: 0px; margin-top:0px;">

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="portal.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;&nbsp;INÍCIO</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
            </ul>
            <span class="navbar-text">
            <ul class="navbar-nav mr-auto">
                <li><a href="logout.php" style="text-decoration: none; color:white;">Sair</a></li>
            </ul>
            </span>
        </div>
    </nav>
    <!-- Navigation bar -->
    
    <!-- Page Content -->
    <div class="container" style="margin-top:10px;">

        <div class="row">
            <div class="col-lg-12">
                <!--<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">-->
                <img src="img/topo.jpg" class="img-fluid" alt="Responsive image">
            </div>  
        </div>  
        <div class="card" style="margin-top:10px">
            
            <div class = "card-header" style="background-color: #3A4182; color:white;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> Alterar sua senha </h3>
                    </div>     
                </div>
                    
            </div>
            <div class="card-body"> 
            <div class="row">
            <div class="col-lg-3 float-left"></div>
            <div class="col-lg-6 card_login" style="margin-top:10px">
                <div class="card">
                    <div class="card-body">
                        <p>
                            <b>Informe uma nova senha e a repita no campo de confirmação. Em seguida clique no botão Alterar Senha.</b><br/>
                            
                        </p>
                            
                        <form role="form" method="post" action="gravar_nova_senha.php" data-toggle="validator" name="login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Senha (Mínimo de 6 caracteres)." name="txtSenha" id="txtSenha" type="password" value="" data-minlength="6" required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Confirme sua senha" name="txtSenhaConfirma" id="txtSenhaConfirma" type="password" value="" data-match="#txtSenha" data-match-error="Atenção! As senhas não estão iguais." required>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <input type="submit" name="btnOK" id="btnOK" value="Alterar Senha" class="btn btn-lg btn-primary btn-block"/>
                            </fieldset>
                        </form>                             
                        
                    </div>
                </div>
            </div>
            </div>      
            </div>
        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/validator.min.js"></script>

  </body>
  
</html>
