<?php
    if (isset($_GET["falha_login"])) {
        $falha = "SIM";
    }
    else {
        $falha = "NAO";
    }

    if (isset($_GET["email_enviado"])) {
        $emailEnviado = $_GET["email_enviado"];
    }
    else {
        $emailEnviado = "NAO";
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/mascaras.js"></script>  

    <title>Portal RH</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
		body {
			padding-top: 10px;
		}
		@media (min-width: 992px) {
			body {
				padding-top: 10px;
			}
		}

    </style>

  </head>

  <body>

    <!-- Page Content -->
    <div class="container">
<?php
    
    if ($falha == "SIM") {
        echo "<div class='alert alert-danger' role='alert'>
                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> 
                <b>Usuário ou senha inválidos.</b>
              </div>";
    }

    if ($emailEnviado != "NAO") {
        echo "<div class='alert alert-success' role='alert'>
                <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> 
                <b>Sua senha foi enviada para o e-mail $emailEnviado</b>
              </div>";
    }    

?>	    	
		<div class="row">
			<div class="col-lg-12">
				<img src="img/portal.jpg" class="img-fluid" alt="Responsive image">
			</div>  
		</div>
		<div class="row" style="margin-top: 20px">
			<div class="col-lg-3">
				&nbsp;
			</div>
			<!-- Login -->
			<div class="col-lg-6" style="margin-top:10px">
				<div class="card">
					<div class = "card-header">
						<h4> Faça seu login: </h3>
					</div>
					<div class="card-body">
						<p>
							<b>Informe seu CPF e sua senha para acessar o portal.</b><br/>
							Se você nunca utilizou o portal, clique no link "Primeiro Acesso" para gerar a sua senha.
							Se não lembra a sua senha, clique no link "Esqueci minha senha".<br/>
						</p>
							
						<form role="form" method="post" action="login.php" data-toggle="validator" name="login">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="CPF (Apenas números)" name="txtCPFLogin" id="txtCPFLogin" onKeyUp="MascaraCPF(login.txtCPFLogin, event);" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<input class="form-control" placeholder="Senha" name="txtSenhaLogin" id="txtSenhaLogin" type="password" value="" required>
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group" style="padding-bottom:20px">
									<div class="col-lg-6 float-left"><a href="recuperar_senha.php">Primeiro acesso</a></div>
									<div class="col-lg-6 float-left text-right"><a href="recuperar_senha.php">Esqueci minha senha</a></div>
								</div>

								<input type="submit" name="btnOK" id="btnOK" value="Entrar" class="btn btn-lg btn-primary btn-block"/>
							</fieldset>
							<input type="hidden" name="codigoBase" value="900010">
							<input type="hidden" name="empresa" value="LIMER-STAMP ESTAMPARIA, FERRAMENTARIA E USINAGEM LTDA">
							<input type="hidden" name="cnpj" value="01.887.856/0001-93">
						</form>								
						
					</div>
				</div>
			</div>
		</div>
	
	</div>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>
  
</html>
