<?php
    session_start();
    require_once("conn.php");
    $usuario = $_SESSION["usuario_chave"];
    $apelido = $_SESSION["apelido"];
    $chave = $_POST["chave"];
    $codigoBase = $_SESSION["codigo_base"];

    $sql = "SELECT CHAVE_AVALIACAO_FUNC_ITEM 
              FROM AVALIACOES_WEB 
             WHERE FUNCIONARIO = $usuario 
               AND CHAVE_MOVTO_AVALIACAO = $chave 
               AND CODIGO_BASE = $codigoBase";

    $ds = oci_parse($conn, $sql);   
    oci_define_by_name($ds, "CHAVE_AVALIACAO_FUNC_ITEM", $chaveAvaliacao);
    oci_execute($ds);   
    oci_fetch_all($ds, $cont);

    oci_execute($ds);

    $erro = "NAO";
    
    while (oci_fetch($ds)) {

        if (isset($_POST[$chaveAvaliacao])) {
            //echo "$chaveAvaliacao = " . $_POST[$chaveAvaliacao] ."<br />";
            $resposta = $_POST[$chaveAvaliacao];

            $sql = "UPDATE AVALIACOES_WEB 
                       SET RESPOSTA = $resposta 
                     WHERE CHAVE_AVALIACAO_FUNC_ITEM = $chaveAvaliacao 
                       AND CODIGO_BASE = $codigoBase";

            echo $sql;

            $dsUpdate = oci_parse($conn, $sql);
            $exec = oci_execute($dsUpdate, OCI_NO_AUTO_COMMIT);
            
            if (!$exec) {
                $e = oci_error($dsUpdate);
                oci_rollback($conn);
                show_erro($e["message"]);   
                $erro = "SIM";
            }
        
            $exec = oci_commit($conn);
            if (!$exec) {
                $e = oci_error($conn);
                show_erro($e["message"]);   
                $erro = "SIM";      
            }
            
            oci_close($conn);
            
        }

    }

    if ($erro == "NAO") {
        header("Location: avaliacoes.php?sucesso=SIM");
    }           




?>