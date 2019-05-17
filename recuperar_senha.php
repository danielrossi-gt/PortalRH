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
		<div class="row">
			<div class="col-lg-12">
				<img src="img/portal_mobile.jpg" class="img-fluid" alt="Responsive image">
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
						<h4> Geração de uma nova senha: </h3>
					</div>
					<div class="card-body">
						<p>
							<b>Informe seu CPF para gerar uma senha de acesso.</b>
						</p>
							
						<form role="form" method="post" action="enviar_senha.php" data-toggle="validator" name="login">
							<fieldset>
								<div class="form-group">
									<input class="form-control" placeholder="CPF (Apenas números)" name="txtCPFLogin" id="txtCPFLogin" onKeyUp="MascaraCPF(login.txtCPFLogin, event);" required>
									<div class="help-block with-errors"></div>
								</div>
								<input type="submit" name="btnOK" id="btnOK" value="Gerar Senha" class="btn btn-lg btn-primary btn-block"/>
							</fieldset>
                            <!-- Informações da Empresa -->
                            <?php  require "empresa.php";  ?>
                            <!-- Informações da Empresa -->
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
