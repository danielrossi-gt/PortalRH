<?php

	require_once('conn.php');
	require_once('vendor/phpmailer/class.phpmailer.php');

	$codigoBase = $_POST["codigoBase"];

	$sql = "SELECT SMTP_SERVIDOR, 
				   SMTP_PORTA,
				   SMTP_REQAUT, 
				   SMTP_USUARIO_FOLHA, 
				   SMTP_SENHA_FOLHA, 
				   LOGIN_SMTP_USUARIO_FOLHA, 
				   LOGIN_SMTP_SENHA_FOLHA 
			  FROM PARAMS_WEB
			 WHERE CODIGO_BASE = $codigoBase";

	$ds = oci_parse($conn, $sql);	
	oci_define_by_name($ds, "SMTP_SERVIDOR", $emailSMTPServidor);
	oci_define_by_name($ds, "SMTP_PORTA", $emailSMTPPorta);
	oci_define_by_name($ds, "SMTP_REQAUT", $emailRequerAut);
	oci_define_by_name($ds, "SMTP_USUARIO_FOLHA", $emailUsuarioSemAut);
	oci_define_by_name($ds, "SMTP_SENHA_FOLHA", $emailSenhaSemAut);
	oci_define_by_name($ds, "LOGIN_SMTP_USUARIO_FOLHA", $emailUsuarioComAut);
	oci_define_by_name($ds, "LOGIN_SMTP_SENHA_FOLHA", $emailSenhaComAut);
	oci_execute($ds);
	oci_fetch($ds);

	function gerar_senha($tamanho, $maiusculas, $minusculas, $numeros, $simbolos){
	  	$ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ"; // $ma contem as letras maiúsculas
	  	$mi = "abcdefghijklmnopqrstuvyxwz"; // $mi contem as letras minusculas
	  	$nu = "0123456789"; // $nu contem os números
	  	//$si = "!@#$%¨&*()_+="; // $si contem os símbolos

	  	$senha = '';

	  	if ($maiusculas){
	        // se $maiusculas for "true", a variável $ma é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($ma);
	  	}
	 
	    if ($minusculas){
	        // se $minusculas for "true", a variável $mi é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($mi);
	    }
	 
	    if ($numeros){
	        // se $numeros for "true", a variável $nu é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($nu);
	    }
	 
	    if ($simbolos){
	        // se $simbolos for "true", a variável $si é embaralhada e adicionada para a variável $senha
	        $senha .= str_shuffle($si);
	    }
	 
	    // retorna a senha embaralhada com "str_shuffle" com o tamanho definido pela variável $tamanho
	    return substr(str_shuffle($senha),0,$tamanho);
	}

	$empresa = $_POST["empresa"];
	$cnpj = $_POST["cnpj"];
	$cpf = $_POST["txtCPFLogin"];

	$cpf = str_replace('-', '', str_replace('.', '', $cpf));
	
	$sql = "SELECT EMAIL, NOME FROM FUNCIONARIOS_WEB WHERE CPF = '$cpf' AND CODIGO_BASE = $codigoBase";
	
	$ds = oci_parse($conn, $sql);	
	oci_define_by_name($ds, "EMAIL", $email);
	oci_define_by_name($ds, "NOME", $nome);
	oci_execute($ds);
	oci_fetch($ds);

	$arr = explode(" ", $nome);
	$apelido = $arr[0];

	$senha = gerar_senha(6, true, true, true, true);
	$senhaCripto = base64_encode($senha);

	$sql = "UPDATE FUNCIONARIOS_WEB SET SENHA = '$senhaCripto' WHERE CPF = '$cpf'";

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


    echo "'$email'";

    if ($erro == "NAO") {

		if ($email != '') 
		{			

			$mail = new PHPMailer();
			$mail->IsSMTP(); // Define que a mensagem será SMTP
			$mail->Host = $emailSMTPServidor; // Endereço do servidor SMTP

			if ($emailRequerAut == 'SIM') {
				$mail->SMTPAuth = true; // Autenticação
				$mail->Username = $emailUsuarioComAut; // Usuário do servidor SMTP
				$mail->Password = $emailSenhaComAut; // Senha da caixa postal utilizada
				$mail->From = $emailUsuarioComAut; 
			}
			else {
				$mail->SMTPAuth = false; // Autenticação
				$mail->Username = $emailUsuarioSemAut; // Usuário do servidor SMTP
				$mail->Password = $emailSenhaSemAut; // Senha da caixa postal utilizada
				$mail->From = $emailUsuarioSemAut; 
			}

			$mail->FromName = "Portal RH";
			$mail->AddAddress($email, $nome);
			//$mail->AddAddress('e-mail@destino2.com.br');
			//$mail->AddCC('copia@dominio.com.br', 'Copia'); 
			//$mail->AddBCC('CopiaOculta@dominio.com.br', 'Copia Oculta');		

			$mail->IsHTML(true); // Define que o e-mail será enviado como HTML
			//$mail->CharSet = 'iso-8859-1'; // Charset da mensagem (opcional)

			$mail->Subject  = "Sua nova senha de acesso ao Portal RH"; // Assunto da mensagem
			$mail->Body = "

				<html lang='pt-br'>
				<body>

				<img src='http://cloud.memphis.com.br/mph_cloud_portal_rh/img/portal_mobile.jpg' width=800 />

				<p><b>Olá $apelido<b> <br/><br/>
				
				A sua nova senha de acesso ao Portal RH é <br/>
				<h3>$senha</h3>

				</body>
				</html>

			";
			$mail->AltBody = '';	
			
			try {
			  	$mail->Send();		
			  	header("Location:index.php?email_enviado=$email");		
			}
			catch (phpmailerException $e) {
      			echo $e->errorMessage(); //Mensagem de erro costumizada do PHPMailer
            }
			
		}
		else {
			header("Location:index.php?email_enviado=INVALIDO");
		}

	}

?>