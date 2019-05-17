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

    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />    

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

            .portal {
                display: block;                
            }
            .portal_mobile {
                display: none !important;
            }
		}

        @media (max-width: 991px) {
            .portal {
                display: none !important;
            }
            .portal_mobile {
                display: block;
            }
        }		

        @media (min-width: 1200px) {
            .card_login {
            	padding-top: 60px;
            }
        } 

        @media (min-width: 1200px) {
            .card_login {
            	padding-top: 65px;
            }
        }  

        @media (max-width: 1199px) {
            .card_login {
            	padding-top: 20px;
            }
            .menos_padding {
            	padding: 2px;
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

    	if ($emailEnviado != 'INVALIDO') {
	        echo "<div class='alert alert-success' role='alert'>
	                <span class='glyphicon glyphicon-envelope' aria-hidden='true'></span> 
	                <b>Sua senha foi enviada para o e-mail $emailEnviado</b>
	              </div>"; 
	    }
	    else {
	        echo "<div class='alert alert-danger' role='alert'>
	                <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> 
	                <b>Não existe um e-mail válido para o CPF informado.</b>
	              </div>";
        }
        
    }    

?>	    	

		<div class="row" style="margin-top: 20px">
			<div class="col-lg-6 portal">
				<img src="img/portal.jpg" class="img-fluid" alt="Responsive image">
			</div> 
			<div class="col-lg-12 portal_mobile">
				<img src="img/portal_mobile.jpg" class="img-fluid" alt="Responsive image">
			</div>  
			<!-- Login -->
			<div class="col-lg-6 card_login" style="margin-top:10px">
				<div class="card">
					<div class = "card-header menos_padding">
						<h4> Faça seu login: </h4>
					</div>
					<div class="card-body">
						<p>
							<b>Informe seu CPF e sua senha para acessar o portal.</b><br/>
							Se você nunca utilizou o portal ou esqueceu sua senha, clique no link "Primeiro Acesso/Recuperar senha".<br/>
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
									<div class="col-lg-12 float-left"><a href="recuperar_senha.php">Primeiro acesso/Recuperar senha</a></div>
								</div>

								<input type="submit" name="btnOK" id="btnOK" value="Entrar" class="btn btn-lg btn-primary btn-block"/>
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
