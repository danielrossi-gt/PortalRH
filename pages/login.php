<?php

	require_once('conn.php');

	$codigoBase = $_POST["codigoBase"];
	$cpf = $_POST["txtCPFLogin"];
	$senha = $_POST["txtSenhaLogin"];
	$confSenha = "";
	
	$senha = base64_encode($senha);

	$cpf = str_replace('-', '', str_replace('.', '', $cpf));
	
	$sql = "SELECT CHAVE, CODIGO_BASE, CPF FROM FUNCIONARIOS_WEB WHERE CPF = '$cpf' AND SENHA = '$senha'";
	echo $sql;
	
	$ds = oci_parse($conn, $sql);	
	oci_define_by_name($ds, "CHAVE", $chave);
	oci_define_by_name($ds, "CODIGO_BASE", $codigoBase);
	oci_define_by_name($ds, "CPF", $cpf);
	oci_define_by_name($ds, "NOME", $nome);
	oci_execute($ds);
	oci_fetch($ds);
	$cont = ocirowcount($ds);
	
	if ($cont == 0) 
	{
		echo "<h3 align='center'>USUÁRIO INVÁLIDO!</h3><br/>";
		echo "<p align='center'><a href='index.html'>VOLTAR</a></p>";
		$login = "NAO";
	}
	else 
	{		

		session_start();
		$_SESSION["usuario_chave"] = $chave;
		$_SESSION["codigo_base"] = $codigoBase;
		$_SESSION["cpf"] = $cpf;

		$sql = "SELECT NOME FROM FUNCIONARIOS_WEB WHERE CHAVE = $chave";
		$ds = oci_parse($conn, $sql);	
		oci_define_by_name($ds, "NOME", $nome);
		oci_execute($ds);
		oci_fetch($ds);	

		$arr = explode(" ", $nome);
		$apelido = $arr[0];
		$login = "SIM";
		$_SESSION["apelido"] = $apelido;

	}

	oci_close($conn);		
	
	if ($login == "SIM") {
		header("Location: portal.php");
	}
	 
?>
