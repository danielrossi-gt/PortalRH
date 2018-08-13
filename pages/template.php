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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="js/cep.js"></script>       
    <script src="js/mascaras.js"></script>  

    <title>Portal RH</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

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
        
        <div class="card" style="margin-top:20px">
            
            <div class = "card-header" style="background-color: #3A4182; color:white;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> Título </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 

                <div class="row" style="text-align:center">
                </div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/validator.min.js"></script>

  </body>
  
</html>
