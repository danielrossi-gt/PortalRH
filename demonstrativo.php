<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];
    $codigoBase = $_SESSION["codigo_base"];
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
                        <h3> Demonstativos de Pagamento </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 

                <div class="row" style="padding-top: 20px">
                    <div class="col-lg-12">
                        <p><b>Clique sobre uma das opções para visualizar: </b></p>
                    </div>
                </div>

                <div class="row" style="padding: 20px"><div class="col-lg-12">
                    <ul>

<?php

    $sql = "SELECT DISTINCT TIPO_MOVTO,
                            DECODE(TIPO_MOVTO,
                                   'ADTO.SAL', 'Adiantamento de Salário',
                                   'FOLHA', 'Folha de Pagamento',
                                   'ADTO.13', 'Adiantamento de Décimo Terceiro', 
                                   'DEC.TERC', 'Décimo Terceiro') TIPO_MOVTO_FMT,
                                   DECODE(SUBSTR(ANO_MES, 5, 2),
                                          '01', 'Janeiro',
                                          '02', 'Fevereiro',
                                          '03', 'Março',
                                          '04', 'Abril',
                                          '05', 'Maio',
                                          '06', 'Junho',
                                          '07', 'Julho',
                                          '08', 'Agosto',
                                          '09', 'Setembro',
                                          '10', 'Outubro',
                                          '11', 'Novembro',
                                          '12', 'Dezembro') || ' ' || SUBSTR(ANO_MES, 1, 4) ANO_MES_FMT,
                            ANO_MES
              FROM FOLHA_WEB 
             WHERE FUNCIONARIO = $usuario
               AND CODIGO_BASE = $codigoBase
             ORDER BY ANO_MES, TIPO_MOVTO  ";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "TIPO_MOVTO", $tipoMovto);
    oci_define_by_name($ds, "TIPO_MOVTO_FMT", $tipoMovtoFmt);
    oci_define_by_name($ds, "ANO_MES_FMT", $anoMesFmt);
    oci_define_by_name($ds, "ANO_MES", $anoMes);
    oci_execute($ds);   
    oci_fetch_all($ds, $cont);

    $cont = ocirowcount($ds);                       

    if ($cont == 0) {
        echo "<li>Você não demonstrativos de pagamento.</li>";
    }
    else {

        $anoMesAnt = '';
        $primeiro = 'SIM';

        oci_execute($ds);
        while (oci_fetch($ds)) {

            if ($anoMesAnt != $anoMes) {

                if ($primeiro == 'SIM') {
                    echo "<li style='list-style: none; margin-top: 10px; margin-bottom: 10px'><h4>$anoMesFmt</h4></li>";
                    $primeiro = 'NAO';
                }
                else {
                    echo "<li style='list-style: none; margin-top: 10px; margin-bottom: 10px'><hr /><h4>$anoMesFmt</h4></li>";
                }
                $anoMesAnt = $anoMes;
            }


            echo "<li><a href='demonstrativo_detalhes.php?anomes=$anoMes&tipomovto=$tipoMovto'><b>$tipoMovtoFmt</b></a></li>";
        }
    }

?>

                    </ul>

                </div></div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  
</html>
