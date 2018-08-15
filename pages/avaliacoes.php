<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];

    if (isset($_GET["sucesso"])) {
        $sucesso = "SIM";
    }
    else {
        $sucesso = "NAO";
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

<?php
    
    if ($sucesso == "SIM") {
        echo "<div class='alert alert-success' role='alert' style='margin-top: 10px'>
                <span class='glyphicon glyphicon-ok' aria-hidden='true'></span> 
                <b>Suas respostas foram gravadas com sucesso.</b>
              </div>";
    }

?>

        <div class="card" style="margin-top:10px">
            
            <div class = "card-header" style="background-color: #3A4182; color:white;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> Avaliações </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 

                <div class="row" style="padding-top: 20px">
                    <div class="col-lg-12">
                        <p><b>Clique sobre a Avaliação para responder:</b></p>
                    </div>
                </div>

                <div class="row" style="padding: 20px">
                    <ul>

<?php

    $sql = "SELECT DISTINCT
                   CHAVE_MOVTO_AVALIACAO,
                   DESCRICAO, 
                   TO_CHAR(PERIODO_INICIAL, 'DD/MM/YYYY') PERIODO_INICIAL, 
                   TO_CHAR(PERIODO_FINAL, 'DD/MM/YYYY') PERIODO_FINAL  
              FROM AVALIACOES_WEB 
             WHERE FUNCIONARIO = $usuario
             ORDER BY PERIODO_INICIAL";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "CHAVE_MOVTO_AVALIACAO", $chave);
    oci_define_by_name($ds, "DESCRICAO", $descricao);
    oci_define_by_name($ds, "PERIODO_INICIAL", $inicio);
    oci_define_by_name($ds, "PERIODO_FINAL", $final);
    oci_execute($ds);   
    oci_fetch_all($ds, $cont);

    $cont = ocirowcount($ds);                       

    if ($cont == 0) {
        echo "<li>Você não possui avaliações pendentes.</li>";
    }
    else {

        oci_execute($ds);
        while (oci_fetch($ds)) {
            echo "<li style='margin-bottom: 20px'><a href='avaliacoes_perguntas.php?chave=$chave'><b>$descricao</b></a><br /> Início: $inicio - Término: $final</li>";
        }
    }

?>

                    <ul>

                </div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/validator.min.js"></script>

  </body>
  
</html>
