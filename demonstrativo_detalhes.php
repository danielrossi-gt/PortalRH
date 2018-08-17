<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];
    $anoMes = $_GET["anomes"];
    $tipoMovto = $_GET["tipomovto"];
    $empresa = $_SESSION["empresa"];
    $cnpj = $_SESSION["cnpj"]; 
?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="vendor/jquery/jquery.min.js"></script>

    <script text="JavaScript">

        function Imprimir() {
            $(holerite).printThis({
            importCSS: true,            // import page CSS
            importStyle: true,         // import style tags
            printContainer: true,       // grab outer container as well as the contents of the selector
            // path to additional css file - use an array [] for multiple
            loadCSS: ["http://localhost/mph_cloud_portal_rh/vendor/bootstrap/css/bootstrap.min.css",
                      "http://localhost/mph_cloud_portal_rh/vendor/bootstrap/css/bootstrap.css"],  
            pageTitle: "Demonstrativo de Pagamento",              // add title to print page
            copyTagClasses: true
            });
        }

    </script>



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

        @media (max-width: 767px) {
            .holeriteFull {
                display: none !important;
            }
        }

        @media (min-width: 768px) {
            .holeriteMobile {
                display: none !important;
            }
            .holeriteFull {
                display: block;
            }
        }

        @media print {
            .holeriteMobile {display: none !important;}
            .holeriteFull {display: block !important;}
        }

        
        td {
            padding: 3px;
        }
        .txtTitulo {
            font-weight: bold;
            font-size: 70%;
        }
        .txtTituloEventos {
            font-weight: bold;
            background-color: grey;
            color: black;
        }
        .txtValor {
            text-align: right
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

                <div class="col-lg-11 float-left">
                    <h4> Demonstativo de Pagamento </h3>
                </div>
                <div class="col-lg-1 float-right align-right" style="padding:0px;">
                    <button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Imprimir" onclick="Imprimir()">
                      <span class="glyphicon glyphicon-print"></span>
                    </button>
                    <a href="demonstrativo.php">
                        <button type="button" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Voltar para Demonstrativos">
                          <span class="glyphicon glyphicon-menu-left"></span>
                        </button>
                    </a>
                </div>  
            </div>

            <div class="card-body"> 
                <div id="holerite" class="holeriteFull" style="padding: 20px">
                    <div class="col-lg-12">

<?php

    $sql = "SELECT DISTINCT 
                   SUBSTR(FO.ANO_MES, 5, 2) ||'/'||SUBSTR(FO.ANO_MES, 1, 4) COMPETENCIA,
                   FN.CODIGO,
                   FN.NOME,
                   TO_CHAR(FN.DT_ADMISSAO, 'DD/MM/YYYY') DT_ADMISSAO,
                   FN.DESC_CUSTO,
                   FN.COD_UNID_FUNCIONAL,
                   SUBSTR(FN.CBO, 1, 1) ||'-'||SUBSTR(FN.CBO, 2, 2)||'.'||SUBSTR(FN.CBO, 4, 3) CBO,
                   FN.CTPS,
                   FN.DESC_CARGO,
                   FN.NOME_BANCO,
                   FN.COD_BCOAGE,
                   FN.NRO_CC 
              FROM FOLHA_WEB FO,
                   FUNCIONARIOS_WEB FN
             WHERE FO.FUNCIONARIO = FN.CHAVE
               AND FO.ANO_MES = '$anoMes'
               AND FO.FUNCIONARIO = $usuario
               AND FO.TIPO_MOVTO = 'FOLHA'";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "COMPETENCIA", $competencia);
    oci_define_by_name($ds, "CODIGO", $codigo);
    oci_define_by_name($ds, "NOME", $nome);
    oci_define_by_name($ds, "DT_ADMISSAO", $dtAdmissao);
    oci_define_by_name($ds, "DESC_CUSTO", $descCusto);
    oci_define_by_name($ds, "COD_UNID_FUNCIONAL", $codUnidFuncional);
    oci_define_by_name($ds, "CBO", $cbo);
    oci_define_by_name($ds, "CTPS", $ctps);
    oci_define_by_name($ds, "DESC_CARGO", $descCargo);
    oci_define_by_name($ds, "NOME_BANCO", $nomeBanco);
    oci_define_by_name($ds, "COD_BCOAGE", $codBcoAge);
    oci_define_by_name($ds, "NRO_CC", $nroCC);
    oci_execute($ds);   
    oci_fetch_all($ds, $cont);

    echo "
        <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>
            <tr>
                <td colspan=6 align='center'><h3>Demonstrativo de Pagamento Mensal<h3></td>
            </tr>
            <tr>
                <td rowspan=2 class='align-middle text-center' style='padding: 0px;'>
                    <img src='.././mph_cloud_portal_rh/img/dp_empresa.jpg' /> </td>
                <td colspan=5><span class='txtTitulo'>Empresa</span><br /><span>$empresa</span></td>
            </tr>
            <tr>
                <td colspan=3><span class='txtTitulo'>CNPJ</span><br/><span>$cnpj</span></td>
                <td colspan=2><span class='txtTitulo'>Competência</span><br /><span>$competencia</span></td>
            </tr>

            <tr>
                <td rowspan=3 class='align-middle text-center' style='padding: 0px; text-align:center'>
                    <img style='align: center' src='.././mph_cloud_portal_rh/img/dp_funcionario.jpg' />
                </td>
                <td colspan=5><span class='txtTitulo'>Nome</span><br /><span>$codigo &nbsp; $nome</span></td>
            </tr>

            <tr>
                <td><span class='txtTitulo'>Admissão</span><br /><span>$dtAdmissao</span></td>
                <td colspan=2><span class='txtTitulo'>Centro de Custo</span><br /><span>$descCusto</span></td>
                <td colspan=2><span class='txtTitulo'>Unidade Funcional</span><br /><span>$codUnidFuncional</span></td>
            </tr>

            <tr>
                <td><span class='txtTitulo'>CBO</span><br /><span>$cbo</span></td>
                <td><span class='txtTitulo'>CTPS</span><br /><span>$ctps</span></td>
                <td><span class='txtTitulo'>Cargo</span><br /><span>$descCargo</span></td>
                <td><span class='txtTitulo'>Banco/Agência</span><br /><span>$codBcoAge</span></td>
                <td><span class='txtTitulo'>Conta</span><br /><span>$nroCC</span></td>
            </tr>
        </table>
        <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>
            <tr>
                <td width=10% class=txtTituloEventos style='background-color:grey'>Evento</td>
                <td class=txtTituloEventos>Descrição</td>
                <td class=txtTituloEventos width=15%>Referência</td>
                <td class=txtTituloEventos width=15%>Vencimentos</td>
                <td class=txtTituloEventos width=15%>Descontos</td>
            </tr>";

    $sql = "SELECT FO.COD_EVENTO,
                   FO.EVENTO,
                   FO.TIPO_EVENTO,
                   FO.REF_CALCULADO,
                   FO.VALOR_CALCULADO,
                   TO_CHAR(FO.DATA_PAGTO, 'DD/MM/YYYY') DATA_PAGTO, 
                   FO.SALARIO_BASE, 
                   FO.BASE_INSS, 
                   FO.BASE_FGTS, 
                   FO.FGTS_MES, 
                   FO.BASE_IRRF   
              FROM FOLHA_WEB FO,
                   FUNCIONARIOS_WEB FN
             WHERE FO.FUNCIONARIO = FN.CHAVE
               AND FO.ANO_MES = $anoMes
               AND FO.FUNCIONARIO = $usuario
               AND FO.TIPO_MOVTO = '$tipoMovto'
             ORDER BY FO.EVENTO";

    $dsEvento = oci_parse($conn, $sql);   
    oci_define_by_name($dsEvento, "COD_EVENTO", $codEvento);
    oci_define_by_name($dsEvento, "EVENTO", $evento);
    oci_define_by_name($dsEvento, "TIPO_EVENTO", $tipoEvento);
    oci_define_by_name($dsEvento, "REF_CALCULADO", $refCalculado);
    oci_define_by_name($dsEvento, "VALOR_CALCULADO", $valorCalculado);
    oci_define_by_name($dsEvento, "DATA_PAGTO", $dataPagto);
    oci_define_by_name($dsEvento, "SALARIO_BASE", $salarioBase);
    oci_define_by_name($dsEvento, "BASE_INSS", $baseINSS);
    oci_define_by_name($dsEvento, "BASE_FGTS", $baseFGTS);
    oci_define_by_name($dsEvento, "FGTS_MES", $FGTSMes);
    oci_define_by_name($dsEvento, "BASE_IRRF", $baseIRRF);
    oci_execute($dsEvento);   
    oci_fetch_all($dsEvento, $cont);

    $totalVencimento = 0;
    $totalDesconto = 0;

    oci_execute($dsEvento);
    while (oci_fetch($dsEvento)) {    

        $refCalculadoFmt = number_format($refCalculado, 2, ',', '.');
        $valorCalculadoFmt = number_format($valorCalculado, 2, ',', '.');

        echo "
            <tr>
                <td width=10%>$codEvento</td>
                <td>$evento</td>
                <td width=15% class=txtValor>$refCalculado</td>";
                
        if ($tipoEvento == 'VENCIMENTO') {
            echo "
                    <td width=15% class=txtValor>$valorCalculadoFmt</td>
                    <td width=15% class=txtValor>&nbsp;</td>
                ";
            $totalVencimento = $totalVencimento + $valorCalculado;
        }
        else {
            echo "
                    <td width=15% class=txtValor>&nbsp;</td>
                    <td width=15% class=txtValor>$valorCalculadoFmt</td>
                ";
            $totalDesconto = $totalDesconto + $valorCalculado;
        }
         
        echo "</tr>";

    }

    $totalDescontoFmt = number_format($totalDesconto, 2, ',', '.');
    $totalVencimentoFmt = number_format($totalVencimento, 2, ',', '.');

    $totalLiquido = $totalVencimento - $totalDesconto;
    $totalLiquidoFmt = number_format($totalLiquido, 2, ',', '.');

    $salarioBase = number_format($salarioBase, 2, ',', '.');
    $baseINSS = number_format($baseINSS, 2, ',', '.');
    $baseFGTS = number_format($baseFGTS, 2, ',', '.');
    $FGTSMes = number_format($FGTSMes, 2, ',', '.');
    $baseIRRF = number_format($baseIRRF, 2, ',', '.');


    echo "
            <tr>
                <td colspan=3><b>TOTAIS:</b></td>
                <td class=txtValor>$totalVencimentoFmt</td>
                <td class=txtValor>$totalDescontoFmt</td>
            </tr>
            <tr>
                <td colspan=3 class='text-right'><b>TOTAL LÍQUIDO:</b></td>
                <td class=txtValor>$totalLiquidoFmt</td>
                <td></td>
            </tr>
            </table>

            <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>

            <tr>
                <td colspan=6 align='center'><b>Base de Cálculos</b></td>
            </tr>

            <tr>
                <td colspan=2>
                    <span class='txtTitulo'>Salário Base</span><br />
                </td>
                <td>
                    <span class='txtTitulo'>Base Cálculo I.N.S.S.</span><br />
                </td>
                <td>
                    <span class='txtTitulo'>Base de Cálculo F.G.T.S.</span><br />
                </td>
                <td>
                    <span class='txtTitulo'>F.G.T.S. do Mês</span><br />
                </td>
                <td>
                    <span class='txtTitulo'>Base de Cálculo I.R.R.F.</span><br />
                </td>
            </tr>

            <tr>
                <td colspan=2 class='txtValor'>$salarioBase</td>
                <td class='txtValor'>$baseINSS</td>                
                <td class='txtValor'>$baseFGTS</td>                
                <td class='txtValor'>$FGTSMes</td>                
                <td class='txtValor'>$baseIRRF</td>                
            </tr>            

            <tr>
                <td colspan=2>
                    <span class='txtTitulo'>Data do Crédito</span><br />
                </td>
                <td rowspan=2 colspan=2>
                    &nbsp;
                </td>
                <td rowspan=2 colspan=2>
                    &nbsp;
                </td>
            </tr>            

            <tr>
                <td colspan=2 class='text-center'>$dataPagto</td>
            </tr>            
            <tr>
                <td colspan=6><span class='txtTitulo'>Memphis</span></td>
            </tr>            
            </table>

        ";

?>

                </div></div>


            <div id="holeriteMobile" class="holeriteMobile" style="padding: 20px">
                <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>
                    <tr><td class='txtTituloEventos'>Identificação</td></tr>
                    <tr><td><span class='txtTitulo'>Competência</span></td></tr>
                    <tr><td><?php echo $competencia ?></td><tr>
                    <tr><td><span class='txtTitulo'>Código</span></td></tr>
                    <tr><td><?php echo $codigo ?></td><tr>
                    <tr><td><span class='txtTitulo'>Nome</span></td></tr>
                    <tr><td><?php echo $nome ?></td></tr>    
                    <!--<tr><td><span class='txtTitulo'>Data de Admissão</span></td></tr>
                    <tr><td><?php echo $dtAdmissao ?></td><tr>    
                    <tr><td><span class='txtTitulo'>Centro de Custo</span></td></tr>
                    <tr><td><?php echo $descCusto ?></td><tr>
                    <tr><td><span class='txtTitulo'>Unidade Funcional</span></td></tr>
                    <tr><td><?php echo $codUnidFuncional ?></td><tr>
                    <tr><td><span class='txtTitulo'>CBO</span></td></tr>
                    <tr><td><?php echo $cbo ?></td><tr>    
                    <tr><td><span class='txtTitulo'>CTPS</span></td></tr>
                    <tr><td><?php echo $ctps ?></td><tr>
                    <tr><td><span class='txtTitulo'>Cargo</span></td></tr>
                    <tr><td><?php echo $descCargo ?></td><tr>
                    <tr><td><span class='txtTitulo'>Banco/Agência</span></td></tr>
                    <tr><td><?php echo $nomeBanco . "  " . $codBcoAge ?></td><tr>    
                    <tr><td><span class='txtTitulo'>Conta</span></td></tr>
                    <tr><td><?php echo $nroCC ?></td><tr> -->

                </table>
                <br />
                <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>
                    <tr><td class='txtTituloEventos'>Eventos</td></tr>

<?php

    $sql = "SELECT FO.COD_EVENTO,
                   FO.EVENTO,
                   FO.TIPO_EVENTO,
                   FO.REF_CALCULADO,
                   FO.VALOR_CALCULADO,
                   TO_CHAR(FO.DATA_PAGTO, 'DD/MM/YYYY') DATA_PAGTO, 
                   FO.SALARIO_BASE, 
                   FO.BASE_INSS, 
                   FO.BASE_FGTS, 
                   FO.FGTS_MES, 
                   FO.BASE_IRRF   
              FROM FOLHA_WEB FO,
                   FUNCIONARIOS_WEB FN
             WHERE FO.FUNCIONARIO = FN.CHAVE
               AND FO.ANO_MES = $anoMes
               AND FO.FUNCIONARIO = $usuario
               AND FO.TIPO_MOVTO = '$tipoMovto'
             ORDER BY FO.EVENTO";

    $dsEvento = oci_parse($conn, $sql);   
    oci_define_by_name($dsEvento, "COD_EVENTO", $codEvento);
    oci_define_by_name($dsEvento, "EVENTO", $evento);
    oci_define_by_name($dsEvento, "TIPO_EVENTO", $tipoEvento);
    oci_define_by_name($dsEvento, "REF_CALCULADO", $refCalculado);
    oci_define_by_name($dsEvento, "VALOR_CALCULADO", $valorCalculado);
    oci_define_by_name($dsEvento, "DATA_PAGTO", $dataPagto);
    oci_define_by_name($dsEvento, "SALARIO_BASE", $salarioBase);
    oci_define_by_name($dsEvento, "BASE_INSS", $baseINSS);
    oci_define_by_name($dsEvento, "BASE_FGTS", $baseFGTS);
    oci_define_by_name($dsEvento, "FGTS_MES", $FGTSMes);
    oci_define_by_name($dsEvento, "BASE_IRRF", $baseIRRF);
    oci_execute($dsEvento);   
    oci_fetch_all($dsEvento, $cont);

    $totalVencimento = 0;
    $totalDesconto = 0;

    oci_execute($dsEvento);
    while (oci_fetch($dsEvento)) { 

        $refCalculadoFmt = number_format($refCalculado, 2, ',', '.');
        $valorCalculadoFmt = number_format($valorCalculado, 2, ',', '.');

        $salarioBase = number_format($salarioBase, 2, ',', '.');
        $baseINSS = number_format($baseINSS, 2, ',', '.');
        $baseFGTS = number_format($baseFGTS, 2, ',', '.');
        $FGTSMes = number_format($FGTSMes, 2, ',', '.');
        $baseIRRF = number_format($baseIRRF, 2, ',', '.');


        echo "
            <tr><td>
                <span class='txtTitulo'>$evento ($tipoEvento)</span>
            </td></tr>
            <tr>
                <td class='txtValor'>$valorCalculadoFmt</td> 
            </td></tr>";
    }

?>
                <tr><td><span class='txtTitulo'>Total Líquido</span></td></tr>
                <tr><td class='txtValor'><?php echo $totalLiquidoFmt; ?></td></td></tr>


                </table>

                </table>
                <br />
                <table class='table table-sm' style='margin-bottom: 0px' border=1 width=100%>
                    <tr><td class='txtTituloEventos'>Bases de Cálculos</td></tr>

                    <tr><td><span class='txtTitulo'>Salario Base</span></td></tr>
                    <tr><td class='txtValor'><?php echo $salarioBase; ?></td></td></tr>

                    <tr><td><span class='txtTitulo'>Base de Cálculo INSS</span></td></tr>
                    <tr><td class='txtValor'><?php echo $baseINSS; ?></td></td></tr>

                    <tr><td><span class='txtTitulo'>Base de Cálculo FGTS</span></td></tr>
                    <tr><td class='txtValor'><?php echo $baseFGTS; ?></td></td></tr>

                    <tr><td><span class='txtTitulo'>Base de Cálculo IRRF</span></td></tr>
                    <tr><td class='txtValor'><?php echo $baseIRRF; ?></td></td></tr>

                </table>

            </div>


            </div>      

        </div>   

    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="./js/printThis.js"></script>

  </body>
  
</html>
