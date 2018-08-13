<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];
    $chave = $_GET["chave"];
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

    <form method="post" action="grava_respostas_avaliacao.php" name="respostas">
        
        <div class="card" style="margin-top:20px">
            
            <div class = "card-header" style="background-color: #3A4182; color:white;">
                <div class="row">
                    <div class="col-lg-12">
                        <h3> Avaliações </h3>
                    </div>          
                </div>
            </div>

            <div class="card-body"> 

<?php
    
    $sql = "SELECT DISTINCT 
                   CODIGO_TITULO_AVALIACAO, 
                   DESCRICAO_TITULO_AVALIACAO 
              FROM AVALIACOES_WEB 
             WHERE FUNCIONARIO = $usuario 
               AND CHAVE_MOVTO_AVALIACAO = $chave 
             ORDER BY CODIGO_TITULO_AVALIACAO";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "CODIGO_TITULO_AVALIACAO", $codigo);
    oci_define_by_name($ds, "DESCRICAO_TITULO_AVALIACAO", $descricao);
    oci_execute($ds);

    while (oci_fetch($ds)) {
        echo "<div class='row' style='padding: 20px'>";
        echo "<div class='col-lg-12'>";
        echo "<h3>$codigo. $descricao</h3><hr/><br/>";

        $sql = "SELECT CHAVE_AVALIACAO_FUNC_ITEM,
                       DESCRICAO_PERGUNTA, 
                       RESPOSTA1, RESPOSTA2, RESPOSTA3, RESPOSTA4, RESPOSTA5, 
                       RESPOSTA6, RESPOSTA7, RESPOSTA8, RESPOSTA9, RESPOSTA10, 
                       RESPOSTA
                  FROM AVALIACOES_WEB 
                 WHERE FUNCIONARIO = $usuario
                   AND CHAVE_MOVTO_AVALIACAO = $chave
                   AND CODIGO_TITULO_AVALIACAO = $codigo 
                 ORDER BY CODIGO_TITULO_AVALIACAO";

        $dsPerg = oci_parse($conn, $sql);   
        oci_define_by_name($dsPerg, "CHAVE_AVALIACAO_FUNC_ITEM", $chaveAvaliacao);
        oci_define_by_name($dsPerg, "DESCRICAO_PERGUNTA", $descricaoPergunta);
        oci_define_by_name($dsPerg, "RESPOSTA1", $resposta1);
        oci_define_by_name($dsPerg, "RESPOSTA2", $resposta2);
        oci_define_by_name($dsPerg, "RESPOSTA3", $resposta3);
        oci_define_by_name($dsPerg, "RESPOSTA4", $resposta4);
        oci_define_by_name($dsPerg, "RESPOSTA5", $resposta5);
        oci_define_by_name($dsPerg, "RESPOSTA6", $resposta6);
        oci_define_by_name($dsPerg, "RESPOSTA7", $resposta7);
        oci_define_by_name($dsPerg, "RESPOSTA8", $resposta8);
        oci_define_by_name($dsPerg, "RESPOSTA9", $resposta9);
        oci_define_by_name($dsPerg, "RESPOSTA10", $resposta10);
        oci_define_by_name($dsPerg, "RESPOSTA", $resposta);
        oci_execute($dsPerg);   
        oci_fetch_all($dsPerg, $cont);

        oci_execute($dsPerg);
        while (oci_fetch($dsPerg)) {

            echo "<b>$descricaoPergunta</b><br/>";

            if ($resposta1 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='1'";
                if ($resposta == '1') {
                    echo " checked ";
                }
                echo "> $resposta1<br/>";
            }   

            if ($resposta2 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='2'";
                if ($resposta == '2') {
                    echo " checked ";
                }
                echo "> $resposta2<br/>";
            }

            if ($resposta3 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='3'";
                if ($resposta == '3') {
                    echo " checked ";
                }
                echo "> $resposta3<br/>";
            }
            
            if ($resposta4 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='4'";
                if ($resposta == '4') {
                    echo " checked ";
                }
                echo "> $resposta4<br/>";
            }

            if ($resposta5 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='5'";
                if ($resposta == '5') {
                    echo " checked ";
                }
                echo "> $resposta5<br/>";
            }

            if ($resposta6 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='6'";
                if ($resposta == '6') {
                    echo " checked ";
                }
                echo "> $resposta6<br/>";
            }

            if ($resposta7 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='7'";
                if ($resposta == '7') {
                    echo " checked ";
                }
                echo "> $resposta7<br/>";
            }

            if ($resposta8 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='8'";
                if ($resposta == '8') {
                    echo " checked ";
                }
                echo "> $resposta8<br/>";
            }

            if ($resposta9 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='9'";
                if ($resposta == '9') {
                    echo " checked ";
                }
                echo "> $resposta9<br/>";
            }

            if ($resposta10 != "") {
                echo "<input type='radio' name='$chaveAvaliacao' id='$chaveAvaliacao' value='10'";
                if ($resposta == '10') {
                    echo " checked ";
                }
                echo "> $resposta10<br/>";
            }

            echo "<br/>";
        }

        echo "</div>";
        echo "</div>";
    }

?>

            </div>      

            <div class="form-group col-lg-12">
                <input type="submit" name="btnOK" id="btnOK" value="Gravar" class="btn btn-lg btn-primary btn-block"/>      
            </div>

        </div>    

        <?php echo "<input type='hidden' name='chave' id='chave' value='$chave'>"; ?>
    </form>
    </div>

    <!-- Bootstrap core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/validator.min.js"></script>

  </body>
  
</html>
