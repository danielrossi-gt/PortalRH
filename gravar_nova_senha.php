<?php

    session_start();

	require_once('conn.php');
	require_once('vendor/phpmailer/class.phpmailer.php');
	
	$codigoBase = $_SESSION["codigo_base"];
	$senha = $_POST["txtSenha"];
	$senhaCripto = base64_encode($senha);
	$cpf = $_SESSION["cpf"];

	$sql = "UPDATE FUNCIONARIOS_WEB SET SENHA = '$senhaCripto' WHERE CPF = '$cpf' AND CODIGO_BASE = $codigoBase";

    $dsUpdate = oci_parse($conn, $sql);
    $exec = oci_execute($dsUpdate, OCI_NO_AUTO_COMMIT);
    
    $erro = "NAO";
        
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

    if ($erro == "NAO") {
    	header("Location:portal.php?senha=SIM");		
	}
	else {
		header("Location:portal.php?senha=ERRO");
	}

?>