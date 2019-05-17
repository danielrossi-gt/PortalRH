<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];

    if (isset($_GET["desenv"])) {
        $desenv = "SIM";
    }
    else {
        $desenv = "NAO";
    }    

    if (isset($_GET["senha"])) {
        $senha = $_GET["senha"];
    }
    else {
        $senha = 'NAO';
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/mascaras.js"></script>  

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

        @media (min-height: 699px) {
            .cabecalho_mobile {
                display: none !important;
                
            }
            .cabecalho {
                display: block;
            }
        }

        @media (max-height: 698px) {
            .cabecalho_mobile {
                display: block;
            }
            .cabecalho {
                display: none !important;
            }
        }

    </style>

  </head>

  <body style="padding-top: 0px; margin-top: 0px;">

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Olá <?php echo " $apelido!" ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
            </ul>
            <span class="navbar-text">
            <ul class="navbar-nav mr-auto">
                <li></li>
                <li><a href="logout.php" style="text-decoration: none; color:white;">Sair</a></li>
            </ul>
            </span>
        </div>
    </nav>
    <!-- Navigation bar -->
    
    <!-- Page Content -->
    <div class="container" style="margin-top: 10px;">

<?php
    
    if ($desenv == "SIM") {
        echo "<div class='alert alert-info' role='alert'>
                <span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span> 
                <b>Opção atualmente em desenvolvimento.</b>
              </div>";
    }

    if ($senha != "NAO") {

        if ($senha != "ERRO") {
             echo "<div class='alert alert-success' role='alert'>
                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> 
                    <b>Sua senha foi alterada com sucesso.</b>
                  </div>"; 
        }
        else {
            echo "<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> 
                    <b>Não foi possível alterar sua senha.</b>
                  </div>";            
        }
    }


?>        

        <div class="row">
            <div class="col-lg-12 cabecalho">
                <img src="img/portal_mobile.jpg" class="img-fluid" alt="Responsive image">
            </div>  
            <div class="col-lg-12 cabecalho_mobile">
                <img src="img/topo.jpg" class="img-fluid" alt="Responsive image">
            </div>  

        </div>        
        
        <div class="card" style="margin-top:20px">
            
            <div class = "card-header" style="background-color: #3A4182; color:white;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> Menu de Opções </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 

                <div class="row" style="text-align:center">

                    <div class="col-lg-3 float-left" style="padding: 10px">
                        <a href="ponto.php">
                            <img src="img/ponto.jpg" class="img-fluid" alt="Consulta de Ponto" data-toggle="tooltip" data-placement="top" title="Consulte suas informações do Ponto Eletrônico">
                        </a>
                    </div>    

                    <div class="col-lg-3 float-left" style="padding: 10px">
                        <a href="demonstrativo.php">
                            <img src="img/dem_pagtos.jpg" class="img-fluid" alt="Demonstrativo de Pagamento" data-toggle="tooltip" data-placement="top" title="Consulte e imprima os seus Demonstrativos de Pagamento">
                        </a>
                    </div>          
      
                    <div class="col-lg-3 float-left" style="padding: 10px">
                        <a href="avaliacoes.php">
                            <img src="img/avaliacoes.jpg" class="img-fluid" alt="Avaliações" data-toggle="tooltip" data-placement="top" title="Verifique e responda suas Avaliações de Desempenho">
                        </a>
                    </div>    

                    <div class="col-lg-3 float-left" style="padding: 10px">
                        <a href="alterar_senha.php">
                            <img src="img/alterar_senha.jpg" class="img-fluid" alt="Alterar Senha" data-toggle="tooltip" data-placement="top" title="Mudar sua senha atual">
                        </a>
                    </div>                        
                          
                </div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  
</html>
