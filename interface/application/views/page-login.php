<!DOCTYPE html>
	<html lang="pt-br"> 
	<head>
		
		<title>Bravi</title>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"> 
		<!--===============================================================================================-->		
		
		<link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
		<!--===============================================================================================-->	
   		
   		<link rel="apple-touch-icon" href="<?=base_url("assets/");?>images/query_icon.png">
    	<link rel="shortcut icon" href="<?=base_url("assets/");?>images/query_icon.png">
		<!--===============================================================================================--> 
		
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/");?>/login/vendor/bootstrap/css/bootstrap.min.css">
		<!--===============================================================================================-->
		
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/");?>/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<!--===============================================================================================-->
		
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/");?>/login/css/util.css">
		<link rel="stylesheet" type="text/css" href="<?=base_url("assets/");?>/login/css/main.css">
		<!--===============================================================================================-->

		<style>
			.wrap-login100 {
				width: initial;
			}
		</style>
	</head>
	<body>
		
		<div class="limiter">

			<div class="container-login100">

				<div class="wrap-login100">
					
					<form class="login100-form validate-form" method="post" action="<?=base_url("auth/login");?>">
			            <input type="hidden" name="uriReturn" value="<?=$this->session->flashdata('uriReturn'); ?>" />
			            <span class="login100-form-title">
							<span style="font-family: 'Montserrat', sans-serif; font-size: 18px">Login</span>
						</span>

						<div class="wrap-input100 validate-input" data-validate = "Usuário é obrigatória">
							<input class="input100" type="text" name="username" placeholder="Usuário">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-user" aria-hidden="true"></i>
							</span>
						</div>

						<div class="wrap-input100 validate-input" data-validate = "Senha é obrigatória">
							<input class="input100" type="password" name="password" placeholder="Senha">
							<span class="focus-input100"></span>
							<span class="symbol-input100">
								<i class="fa fa-lock" aria-hidden="true"></i>
							</span>
						</div>
						
						<div class="container-login100-form-btn">
							<button class="login100-form-btn">
								Entrar
							</button>
						</div>

					</form>
				</div>
			</div>
		</div>

	<!--===============================================================================================-->	
		<script src="<?=base_url("assets/");?>/login/vendor/jquery/jquery-3.2.1.min.js"></script>
		<script src="<?=base_url("assets/");?>/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="<?=base_url("assets/");?>/login/vendor/tilt/tilt.jquery.min.js"></script>
		<script >
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script>
	<!--===============================================================================================-->
		<script src="<?=base_url("assets/");?>/login/js/main.js"></script>
	</body>
	</html>


