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

?>        

        <div class="row">
            <div class="col-lg-12">
                <!--<img src="http://via.placeholder.com/1151x250" class="img-fluid" alt="Responsive image">-->
                <img src="img/portal.jpg" class="img-fluid" alt="Responsive image">
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

                    <div class="col-lg-4 float-left" style="padding: 10px">
                        <a href="portal.php?desenv=SIM"><img src="img/ponto.jpg" class="img-fluid" alt="Consulta de Ponto"></a>
                    </div>    

                    <div class="col-lg-4 float-left" style="padding: 10px">
                        <a href="portal.php?desenv=SIM"><img src="img/dem_pagtos.jpg" class="img-fluid" alt="Demonstrativo de Pagamento"></a>
                    </div>          
      
                    <div class="col-lg-4 float-left" style="padding: 10px">
                        <a href="avaliacoes.php"><img src="img/avaliacoes.jpg" class="img-fluid" alt="Avaliações"></a>
                    </div>    
                          
                </div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/validator.min.js"></script>

  </body>
  
</html>
