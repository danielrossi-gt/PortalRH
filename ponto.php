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

        #loader {
          position: absolute;
          left: 50%;
          top: 50%;
          z-index: 1;
          width: 150px;
          height: 150px;
          margin: -75px 0 0 -75px;
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid #3498db;
          width: 120px;
          height: 120px;
          -webkit-animation: spin 2s linear infinite;
          animation: spin 2s linear infinite;
        }

        @-webkit-keyframes spin {
          0% { -webkit-transform: rotate(0deg); }
          100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
          0% { transform: rotate(0deg); }
          100% { transform: rotate(360deg); }
        }

        /* Add animation to "page content" */
        .animate-bottom {
          position: relative;
          -webkit-animation-name: animatebottom;
          -webkit-animation-duration: 1s;
          animation-name: animatebottom;
          animation-duration: 1s
        }

        @-webkit-keyframes animatebottom {
          from { bottom:-100px; opacity:0 } 
          to { bottom:0px; opacity:1 }
        }

        @keyframes animatebottom { 
          from{ bottom:-100px; opacity:0 } 
          to{ bottom:0; opacity:1 }
        }

        #myDiv {
          display: none;
          text-align: center;
        }   

    </style>

    <script type="text/javascript">
        
          function toggle_it(itemID){ 
              // Toggle visibility between none and '' 
              if ((document.getElementById(itemID).style.display == 'none')) { 
                    document.getElementById(itemID).style.display = '' 
                    event.preventDefault()
              } else { 
                    document.getElementById(itemID).style.display = 'none'; 
                    event.preventDefault()
              }    
          } 

    </script>


  </head>

  <body style="padding-top: 0px; margin-top:0px;" onload="myFunction()">

    <div id="loader" class="loader"></div>   

    <div style="display:none;" id="myDiv">     

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
                        <h3> Ponto Eletrônico </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 
                <div class="row" style="padding: 20px"><div class="col-lg-12">

<?php

    $sql = "SELECT CHAVE,
                   TO_CHAR(DATA, 'DD/MM/YYYY') DATA,
                   SUBSTR(HORARIO_1, 1, 2) ||':'|| SUBSTR(HORARIO_1, 3, 2) HORARIO_1,
                   SUBSTR(HORARIO_2, 1, 2) ||':'|| SUBSTR(HORARIO_2, 3, 2) HORARIO_2,
                   SUBSTR(HORARIO_3, 1, 2) ||':'|| SUBSTR(HORARIO_3, 3, 2) HORARIO_3,
                   SUBSTR(HORARIO_4, 1, 2) ||':'|| SUBSTR(HORARIO_4, 3, 2) HORARIO_4,
                   SUBSTR(HORARIO_5, 1, 2) ||':'|| SUBSTR(HORARIO_5, 3, 2) HORARIO_5,
                   SUBSTR(HORARIO_6, 1, 2) ||':'|| SUBSTR(HORARIO_6, 3, 2) HORARIO_6,
                   SUBSTR(HORARIO_7, 1, 2) ||':'|| SUBSTR(HORARIO_7, 3, 2) HORARIO_7,
                   SUBSTR(HORARIO_8, 1, 2) ||':'|| SUBSTR(HORARIO_8, 3, 2) HORARIO_8,
                   FERIADO, 
                   DESTACA_APTO 
              FROM MARCACOES_WEB 
             WHERE CODIGO_BASE = $codigoBase 
               AND FUNCIONARIO = $usuario
             ORDER BY MARCACOES_WEB.DATA DESC";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "CHAVE", $chaveMarcacoes);
    oci_define_by_name($ds, "DATA", $data);
    oci_define_by_name($ds, "HORARIO_1", $horario1);
    oci_define_by_name($ds, "HORARIO_2", $horario2);
    oci_define_by_name($ds, "HORARIO_3", $horario3);
    oci_define_by_name($ds, "HORARIO_4", $horario4);
    oci_define_by_name($ds, "HORARIO_5", $horario5);
    oci_define_by_name($ds, "HORARIO_6", $horario6);
    oci_define_by_name($ds, "HORARIO_7", $horario7);
    oci_define_by_name($ds, "HORARIO_8", $horario8);
    oci_define_by_name($ds, "FERIADO", $feriado);
    oci_define_by_name($ds, "DESTACA_APTO", $destacaApto);
    oci_execute($ds);   
    oci_fetch_all($ds, $cont);

    $cont = ocirowcount($ds);  

    if ($cont == 0) {
        echo "<li>Você não possui dados de ponto eletrônico.</li>";
    }
    else {

        echo "<p class='h6'>Feriados aparecem com fundo verde. Apontamentos destacados aparecem em negrito.</p>";

        echo "<div class='table-responsive'><table class='table'>
              <thead>
                <tr>
                  <th scope='col'>Data</th>
                  <th scope='col'>Entrada</th>
                  <th scope='col'>Saída</th>
                  <th scope='col'>Entrada</th>
                  <th scope='col'>Saída</th>
                  <th scope='col'>Entrada</th>
                  <th scope='col'>Saída</th>
                  <th scope='col'>Entrada</th>
                  <th scope='col'>Saída</th>
                </tr>
              </thead>";        

        oci_execute($ds);
        while (oci_fetch($ds)) {

            if ($feriado == 'SIM') {

                if ($destacaApto == 'SIM') {
                    $cor =  "style='background-color: green; font-weight: bold; color: white;'";
                }
                else {
                    $cor =  "style='background-color: green; color: white;'";
                }

            }
            else {

                if ($destacaApto == 'SIM') {
                    $cor =  "style='font-weight: bold;'";
                }
                else {
                    $cor =  "";
                }
            }

            $sql = "SELECT CODIGO,
                           DESCRICAO,
                           QUANTIDADE,
                           BANCO_HORAS
                      FROM APONTAMENTOS_WEB 
                     WHERE CHAVE_MARCACOES = $chaveMarcacoes";

            $dsMarcacoes = oci_parse($conn, $sql);   
            oci_define_by_name($dsMarcacoes, "CODIGO", $codigo);
            oci_define_by_name($dsMarcacoes, "DESCRICAO", $descricao);
            oci_define_by_name($dsMarcacoes, "QUANTIDADE", $quantidade);
            oci_define_by_name($dsMarcacoes, "BANCO_HORAS", $bancoHoras);
            oci_execute($dsMarcacoes);   
            oci_fetch_all($dsMarcacoes, $cont);

            echo "<tr $cor>";
            if (oci_num_rows($dsMarcacoes) > 0) {
              echo "<td><a href=\"#\" id=\"toggle\" onClick=\"toggle_it('$chaveMarcacoes');\">$data</a></td>";
            }
            else {
              echo "<td>$data</td>";
            }

            echo "<td> $horario1 </td>";
            echo "<td> $horario2 </td>";
            echo "<td> $horario3 </td>";
            echo "<td> $horario4 </td>";
            echo "<td> $horario5 </td>";
            echo "<td> $horario6 </td>";
            echo "<td> $horario7 </td>";
            echo "<td> $horario8 </td>";
            echo "</tr>";

            if (oci_num_rows($dsMarcacoes) > 0) {

                echo "<tr style='font-size:small;display:none;' id='$chaveMarcacoes' ><td colspan=9><table width=100%>";
                oci_execute($dsMarcacoes);
                while (oci_fetch($dsMarcacoes)) { 
                    echo "<tr><td>&nbsp</td>
                              <td>Código: <b>$codigo</b></td> 
                              <td>Descrição: <b>$descricao</b> </td>
                              <td>Quantidade: <b>$quantidade</b> </td>
                              <td>Banco de Horas: <b>$bancoHoras</b> </td></tr>";
                }
                echo "</table></td></tr>";

            }


        }

        echo "</table></div>";

    }

?>

                </div></div>

            </div>      

        </div>    
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>


    </div>

    <script>
    var myVar;

    function myFunction() {
      myVar = setTimeout(showPage, 3000);
    }

    function showPage() {
      document.getElementById("loader").style.display = "none";
      document.getElementById("myDiv").style.display = "block";
    }
    </script>

  </body>
  
</html>
