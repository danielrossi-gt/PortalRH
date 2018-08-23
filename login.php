<?php

	require_once('conn.php');

	$codigoBase = $_POST["codigoBase"];
	$empresa = $_POST["empresa"];
	$cnpj = $_POST["cnpj"];
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

	echo "cont: ".$cont;

	$login = 'NAO';
	
	if ($cont > 0) 
	{		

		session_start();
		$_SESSION["usuario_chave"] = $chave;
		$_SESSION["codigo_base"] = $codigoBase;
		$_SESSION["empresa"] = $empresa;
		$_SESSION["cnpj"] = $cnpj;
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

		$sql = "SELECT SMTP_REQAUT, 
					   SMTP_USUARIO_FOLHA, 
					   SMTP_SENHA_FOLHA, 
					   LOGIN_SMTP_USUARIO_FOLHA, 
					   LOGIN_SMTP_SENHA_FOLHA 
				  FROM PARAMS_WEB";

		$ds = oci_parse($conn, $sql);	
		oci_define_by_name($ds, "SMTP_REQAUT", $emailRequerAut);
		oci_define_by_name($ds, "SMTP_USUARIO_FOLHA", $emailUsuarioSemAut);
		oci_define_by_name($ds, "SMTP_SENHA_FOLHA", $emailSenhaSemAut);
		oci_define_by_name($ds, "LOGIN_SMTP_USUARIO_FOLHA", $$emailUsuarioComAlt);
		oci_define_by_name($ds, "LOGIN_SMTP_SENHA_FOLHA", $emailSenhaComAlt);
		oci_execute($ds);
		oci_fetch($ds);

		$_SESSION["emailRequerAut"] = $emailRequerAut;
		$_SESSION["emailUsuarioSemAut"] = $emailUsuarioSemAut;
		$_SESSION["emailSenhaSemAut"] = $emailSenhaSemAut;
		$_SESSION["emailUsuarioComAlt"] = $emailUsuarioComAlt;
		$_SESSION["emailSenhaComAlt"] = $emailSenhaComAlt;								

	}

	oci_close($conn);		
	
	if ($login == "SIM") {
		header("Location: portal.php");
	}
	else {
		header("Location:index.php?falha_login=SIM");		
	}
	 
?>

